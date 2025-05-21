<?php
namespace App\Controllers;
use App\Models\Reservation;
use App\Views\Display;

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
        if (empty($data['room_id']) || empty($data['guest_id']) || empty($data['days']) || empty($data['date'])) {   
            $_SESSION['warning_message'] = "ReservationController: save()";
            $this->redirect('/reservations/create'); // Redirect if input is invalid
        }
        // Use the existing model instance
        $this->model->room_id = $data['room_id'];
        $this->model->guest_id = $data['guest_id'];
        $this->model->days = $data['days'];
        $this->model->date = $data['date'];
        $this->model->create();
        $this->redirect('/reservations');
    }

    public function update(int $id, array $data): void
    {
        $reservation = $this->model->find($id);
        if (!empty($data['room_id']) || !empty($data['guest_id']) || !empty($data['days']) || !empty($data['date'])) {
            // Handle invalid ID or data
            $this->redirect('/reservations');
        }
        $this->model->room_id = $data['room_id'];
        $this->model->guest_id = $data['guest_id'];
        $this->model->days = $data['days'];
        $this->model->date = $data['date'];
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
