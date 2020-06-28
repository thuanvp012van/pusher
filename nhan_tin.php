<?php
if (!empty($_POST['nd'])) {
    require __DIR__ . '/vendor/autoload.php';

    $options = array(
        'cluster' => 'ap1',
        'useTLS' => true
    );
    $pusher = new Pusher\Pusher(
        '576aec32d50bd84ba5f3',
        'db4ff4d3ae788a7c7ce2',
        '989814',
        $options
    );
    $data['nd'] = $_POST['nd'];
    $data['ng_gui'] = $_POST['ng_gui'];
    $pusher->trigger($_POST['id'], 'nhan_tin', $data);
}
