<?php
    return array(
    'guest' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Гость',
        'bizRule' => null,
        'data' => null
    ),
    'acceptor' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Приемщик',
        'children' => array(
            'guest', // унаследуемся от гостя
        ),
        'bizRule' => null,
        'data' => null
    ),
    'engineer' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Инженер',
        'children' => array(
            'guest',          // позволим модератору всё, что позволено пользователю
        ),
        'bizRule' => null,
        'data' => null
    ),
    'admin' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Администратор',
        'children' => array(
            'engineer',
            'acceptor',
        ),
        'bizRule' => null,
        'data' => null
    ),
);
?>
