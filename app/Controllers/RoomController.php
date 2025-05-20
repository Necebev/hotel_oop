<?php
namespace App\Controllers;
use App\Models\Room;
use App\Views\Display;

class RoomController extends Controller {

    public function __construct()
    {
        $room = new Room();
        parent::__construct($room);
    }

    public function index(): void
    {
        $rooms = $this->model->all(['order_by' => ['id, floor, room_number, space, price, note'], 'direction' => ['ASC']]);
        $this->render('rooms/index', ['rooms' => $rooms]);
    }

    public function create(): void
    {
        $this->render('rooms/create');
    }
    public function edit(int $id): void
    {
        $room = $this->model->find($id);
        if (!$room) {
            // Handle invalid ID gracefully
            $_SESSION['warning_message'] = "RoomController: edit()";
            $this->redirect('/rooms');
        }
        $this->render('rooms/edit', ['room' => $room]);
    }

    public function save(array $data): void
    {
        if (empty($data['floor']) || empty($data['room_number']) || empty($data['space']) || empty($data['price']) || empty($data['note'])) {   
            $_SESSION['warning_message'] = "RoomController: save()";
            $this->redirect('/rooms/create'); // Redirect if input is invalid
        }
        // Use the existing model instance
        $this->model->floor = $data['floor'];
        $this->model->room_number = $data['room_number'];
        $this->model->space = $data['space'];
        $this->model->price = $data['price'];
        $this->model->note = $data['note'];
        $this->model->create();
        $this->redirect('/rooms');
    }

    public function update(int $id, array $data): void
    {
        $room = $this->model->find($id);
        if (!$room || empty($data['floor']) || empty($data['room_number']) || empty($data['space']) || empty($data['price']) || empty($data['note'])) {
            // Handle invalid ID or data
            $this->redirect('/rooms');
        }
        $room->floor = $data['floor'];
        $room->room_number = $data['room_number'];
        $room->space = $data['space'];
        $room->price = $data['price'];
        $room->note = $data['note'];
        $room->update();
        $this->redirect('/rooms');
    }

    function show(int $id): void
    {
        $room = $this->model->find($id);
        if (!$room) {
            $_SESSION['warning_message'] = "RoomController: show()";
            $this->redirect('/rooms'); // Handle invalid ID
        }
        $this->render('rooms/show', ['room' => $room]);
    }

    function delete(int $id): void
    {
        $room = $this->model->find($id);
        if ($room) {
            $result = $room->delete();
            if ($result) {
                $_SESSION['success_message'] = 'Sikeresen törölve';
            }
        }

        $this->redirect('/rooms'); // Redirect regardless of success
    }

}
