<?php

return [
    //Блоки лэндинга с описанием полей и вложенным описанием группы чего-нибудь, если она присутствует в блоке
    //Пока группа в блок предусмотрена только одна, если будет больше групп в блоке, то делать 2 блок с тем же имененм, только префиксованный и добавлять группу туда

    'oforml_ideal_wedd' => [
        'title' => 'Оформление идеальных свадеб',
        'stringfields' => ['remark_1', 'remark_2'],
        'textfields' => ['descr_1', 'descr_2'],
        'images' => ['women'],
        'group' => [
            'images' => ['picture'],
            'stringfields' => ['title']
        ]
    ],

    'flower_wizard' => [
        'title' => 'Цветочные волшебники',
        'stringfields' => ['subtitle', 'remark', 'link'],
        'textfields' => ['descr_1', 'descr_2'],
        'images' => ['wizards', 'newlyweds'],
        'group' => [
            'stringfields' => ['title'],
            'textfields' => ['descr'],
            'images' => ['picture']
        ]
    ],

    'dreams_wedd' => [
        'title' => 'Как мечты становятся свадьбой',
        'stringfields' => ['slogan', 'remark', 'appeal'],
        'group' => [
            'stringfields' => ['title'],
            'textfields' => ['descr'],
            'images' => ['picture']
        ]
    ],





    'our_works' => [
        'title' => 'Наши работы',
        'group' => [
            'stringfields' => ['title', 'remark'],
            'textfields' => ['descr'],
            'images' => [
                'prew_pict',
                'picture_1',
                'picture_2',
                'picture_3',
                'picture_4',
                'picture_5',
                'picture_6',
                'picture_7',
                'picture_8',
                'picture_9',
                'picture_10',
                'picture_11',
                'picture_12',
                'picture_13',
                'picture_14',
                'picture_15',
                'picture_16',
                'picture_17',
                'picture_18',
                'picture_19',
                'picture_20',
                'picture_21',
                'picture_22',
                'picture_23',
                'picture_24',
                'picture_25',
                'picture_26',
                'picture_27',
                'picture_28',
                'picture_29',
                'picture_30'],
            'numbs' => ['price']
        ]
    ],





    'howto_help' => [
        'title' => 'Как оформить свадьбу красиво и недорого',
        'stringfields' => ['quest_main'],
        'textfields' => ['quest_list']
    ],




    'decor_elem_titles' => [
        'title' => 'Элементы оформления',
        'stringfields' => ['lead', 'subtitle_1', 'subtitle_2', 'subtitle_3', 'subtitle_4']
    ],

    'decor_elem_1' => [
        'title' => 'Элемент оформления - букет невесты',
        'group' => [
            'stringfields' => ['title'],
            'textfields' => ['descr'],
            'images' => ['picture'],
            'numbs' => ['price']
        ]
    ],

    'decor_elem_2' => [
        'title' => 'Элемент оформления - бутоньерки жениха',
        'group' => [
            'stringfields' => ['title'],
            'textfields' => ['descr'],
            'images' => ['picture'],
            'numbs' => ['price']
        ]
    ],

    'decor_elem_3' => [
        'title' => 'Элемент оформления - оформление торжества',
        'group' => [
            'stringfields' => ['title'],
            'textfields' => ['descr'],
            'images' => ['picture'],
            'numbs' => ['price']
        ]
    ],

    'decor_elem_4' => [
        'title' => 'Элемент оформления - оформление кортежа',
        'group' => [
            'stringfields' => ['title'],
            'textfields' => ['descr'],
            'images' => ['picture'],
            'numbs' => ['price']
        ]
    ],


    'tell_us' => [
        'title' => 'Расскажите, о какой свадьбе вы мечтаете?',
        'stringfields' => ['placeholder', 'appeal']
    ],

    'have_question' => [
        'title' => 'Возник вопрос?',
        'stringfields' => ['phone', 'remark']
    ]

];