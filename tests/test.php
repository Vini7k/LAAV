<?php
    $eventos = array(
        array(
            'title' => 'Evento 1',
            'start' => '2023-11-28T10:00:00',
            'end' => '2023-11-28T12:00:00',
        ),
        array(
            'title' => 'Evento 2',
            'start' => '2023-11-29T14:00:00',
            'end' => '2023-11-29T16:00:00',
        ),
    );

    header('Content-Type: application/json');
    echo json_encode($eventos);
?>