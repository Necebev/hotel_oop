<?php
namespace App\Controllers;
use App\Models\Reservation;
use App\Views\Display;
use App\Database\Database;

class ReservationController extends Controller {

    public function __construct()
    {
        $reservation = new Reservation();
        parent::__construct($reservation);
    }

    public function index(): void
    {
        $reservations = $this->model->all(['order_by' => ['id, room_id, guest_id, days, date'], 'direction' => ['ASC']]);
        $this->render('reservations/index', ['reservations' => $reservations]);
    }

    public function create(): void
    {
        $this->render('reservations/create');
    }
    public function edit(int $id): void
    {
        $reservation = $this->model->find($id);
        if (!$reservation) {
            // Handle invalid ID gracefully
            $_SESSION['warning_message'] = "ReservationController: edit()";
            $this->redirect('/reservations');
        }
        $this->render('reservations/edit', ['reservation' => $reservation]);
    }

    public function save(array $data): void
    {
        $date = Database::getInstance()->execSql("SELECT id, date, days, room_id FROM reservations where room_id = {$data['room_id']}");
        if (empty($data['room_id']) || empty($data['guest_id']) || empty($data['days']) || empty($data['date'])) {   
            $_SESSION['warning_message'] = "ReservationController: save()";
            $this->redirect('/reservations/create'); // Redirect if input is invalid
        }
        // Use the existing model instance
        $currentStartDate = strtotime($data['date']);
        $currentEndDate = strtotime($data['date'] . ' + ' . $data['days'] . ' days');
        foreach ($date as $reservation) {
            $existingStartDate = strtotime($reservation['date']);
            $existingEndDate = strtotime($reservation['date'] . ' + ' . $reservation['days'] . ' days');
            if (!($currentStartDate > $existingEndDate || $currentEndDate < $existingStartDate)) {
                $this->redirect('/reservations');
                $_SESSION['warning_message'] = "Ütközik a foglalás! Kérem, válasszon másik szobát vagy időpontot.";
            }
        }
        $_SESSION['success_message'] = "Sikeresen hozzáadva";
        $this->model->room_id = $data['room_id'];
        $this->model->guest_id = $data['guest_id'];
        $this->model->days = $data['days'];
        $this->model->date = $data['date'];
        $this->model->create();
        $this->redirect('/reservations');
    }

    public function update(int $id, array $data): void
    {
        $date = Database::getInstance()->execSql("SELECT * FROM reservations where room_id = {$data['room_id']}");
        $reservation = $this->model->find($id);
        if (!$reservation || empty($data['room_id']) || empty($data['guest_id']) || empty($data['days']) || empty($data['date'])) {
            // Handle invalid ID or data
            $this->redirect('/reservations');
        }
        // Use the existing model instance
        $currentStartDate = strtotime($data['date']);
        $currentEndDate = strtotime($data['date'] . ' + ' . $data['days'] . ' days');
        foreach ($date as $existingReservation) {
            $existingStartDate = strtotime($existingReservation['date']);
            $existingEndDate = strtotime($existingReservation['date'] . ' + ' . $existingReservation['days'] . ' days');
            if (!($currentStartDate > $existingEndDate || $currentEndDate < $existingStartDate) && $existingReservation['id'] != $id) {
                $_SESSION['warning_message'] = "Ütközik a foglalás! Kérem, válasszon másik szobát vagy időpontot.";
                $this->redirect('/reservations');
            }
        }
        $_SESSION['success_message'] = "Sikeresen frissítve";
        $reservation->room_id = $data['room_id'];
        $reservation->guest_id = $data['guest_id'];
        $reservation->days = $data['days'];
        $reservation->date = $data['date'];
        $reservation->update();
        $this->redirect('/reservations');
    }

    function show(int $id): void
    {
        $reservation = $this->model->find($id);
        if (!$reservation) {
            $_SESSION['warning_message'] = "ReservationController: show()";
            $this->redirect('/reservations'); // Handle invalid ID
        }
        $this->render('reservations/show', ['reservation' => $reservation]);
    }

    function delete(int $id): void
    {
        $reservation = $this->model->find($id);
        if ($reservation) {
            $result = $reservation->delete();
            if ($result) {
                $_SESSION['success_message'] = 'Sikeresen törölve';
            }
        }

        $this->redirect('/reservations'); // Redirect regardless of success
    }

}
