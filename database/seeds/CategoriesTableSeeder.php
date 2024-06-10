<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category1 = Category::create([
            'name' => [
                'ru' => 'Мобильные телефоны и аксессуары к ним',
                'uz' => 'Мобильные телефоны и аксессуары к ним'
            ],
            'slug' => str_slug('Мобильные телефоны и аксессуары к ним'),
            'position' => 1
        ]);

        $category2 = Category::create([
            'name' => [
                'ru' => 'Телевизоры и Видеотехника',
                'uz' => 'Телевизоры и Видеотехника'
            ],
            'slug' => str_slug('Телевизоры и Видеотехника'),
            'position' => 2
        ]);

        $category3 = Category::create([
            'name' => [
                'ru' => 'Ноутбуки и компьютеры',
                'uz' => 'Ноутбуки и компьютеры'
            ],
            'slug' => str_slug('Ноутбуки и компьютеры'),
            'position' => 3
        ]);

        $category4 = Category::create([
            'name' => [
                'ru' => 'Фотоаппараты и видеокамеры',
                'uz' => 'Фотоаппараты и видеокамеры'
            ],
            'slug' => str_slug('Фотоаппараты и видеокамеры'),
            'position' => 4
        ]);

        $category5 = Category::create([
            'name' => [
                'ru' => 'Крупная бытовая техника',
                'uz' => 'Крупная бытовая техника'
            ],
            'slug' => str_slug('Крупная бытовая техника'),
            'position' => 5
        ]);

        $category6 = Category::create([
            'name' => [
                'ru' => 'Мелкая бытовая техника',
                'uz' => 'Мелкая бытовая техника'
            ],
            'slug' => str_slug('Мелкая бытовая техника'),
            'position' => 6
        ]);

        $category7 = Category::create([
            'name' => [
                'ru' => 'Техника для ухода за собой',
                'uz' => 'Техника для ухода за собой'
            ],
            'slug' => str_slug('Техника для ухода за собой'),
            'position' => 7
        ]);

        $category1_1 = $category1->parents()->create([
            'name' => [
                'ru' => 'Смартфоны',
                'uz' => 'Смартфоны'
            ],
            'slug' => str_slug('Смартфоны'),
            'position' => 8
        ]);

        $category1_2 = $category1->parents()->create([
            'name' => [
                'ru' => 'Аксессуары',
                'uz' => 'Аксессуары'
            ],
            'slug' => str_slug('Аксессуары'),
            'position' => 8
        ]);

        $category1_1->parents()->createMany([
            [
                'name' => [
                    'ru' => 'Смартфоны SAMSUNG',
                    'uz' => 'Смартфоны SAMSUNG'
                ],
                'slug' => str_slug('Смартфоны SAMSUNG'),
                'position' => 9
            ],
            [
                'name' => [
                    'ru' => 'Смартфоны Apple iPhone',
                    'uz' => 'Смартфоны Apple iPhone'
                ],
                'slug' => str_slug('Смартфоны Apple iPhone'),
                'position' => 10
            ],
            [
                'name' => [
                    'ru' => 'Смартфоны Xiaomi',
                    'uz' => 'Смартфоны Xiaomi'
                ],
                'slug' => str_slug('Смартфоны Xiaomi'),
                'position' => 11
            ],
            [
                'name' => [
                    'ru' => 'Аксессуары Хiaomi',
                    'uz' => 'Аксессуары Хiaomi'
                ],
                'slug' => str_slug('Аксессуары Хiaomi'),
                'position' => 12
            ],
            [
                'name' => [
                    'ru' => 'Рации',
                    'uz' => 'Рации'
                ],
                'slug' => str_slug('Рации'),
                'position' => 13
            ],
            [
                'name' => [
                    'ru' => 'Аксессуары для телефонов',
                    'uz' => 'Аксессуары для телефонов'
                ],
                'slug' => str_slug('Аксессуары для телефонов'),
                'position' => 14
            ],
            [
                'name' => [
                    'ru' => 'Мобильные телефоны',
                    'uz' => 'Мобильные телефоны'
                ],
                'slug' => str_slug('Мобильные телефоны'),
                'position' => 15
            ],
            [
                'name' => [
                    'ru' => 'Домашние телефоны',
                    'uz' => 'Домашние телефоны'
                ],
                'slug' => str_slug('Домашние телефоны'),
                'position' => 16
            ]
        ]);

        $category1_2->parents()->createMany([
            [
                'name' => [
                    'ru' => 'Проводные наушники',
                    'uz' => 'Проводные наушники'
                ],
                'slug' => str_slug('Проводные наушники'),
                'position' => 17
            ],
            [
                'name' => [
                    'ru' => 'Bluetooth гарнитура и наушники',
                    'uz' => 'Bluetooth гарнитура и наушники'
                ],
                'slug' => str_slug('Bluetooth гарнитура и наушники'),
                'popular' => true,
                'image' => 'vendor/site/img/popular_category-icon4.png',
                'position' => 18
            ],
            [
                'name' => [
                    'ru' => 'Беспроводная акустика',
                    'uz' => 'Беспроводная акустика'
                ],
                'slug' => str_slug('Беспроводная акустика'),
                'position' => 19
            ]
        ]);

        $category2_1 = $category2->parents()->create([
            'name' => [
                'ru' => 'Телевизоры',
                'uz' => 'Телевизоры'
            ],
            'slug' => str_slug('Телевизоры'),
            'position' => 20
        ]);

        $category2_2 = $category2->parents()->create([
            'name' => [
                'ru' => 'Видеотехника',
                'uz' => 'Видеотехника'
            ],
            'slug' => str_slug('Видеотехника'),
            'position' => 21
        ]);

        $category2_1->parents()->createMany([
            [
                'name' => [
                    'ru' => 'LED - телевизоры',
                    'uz' => 'LED - телевизоры'
                ],
                'slug' => str_slug('LED - телевизоры'),
                'position' => 22
            ],
            [
                'name' => [
                    'ru' => 'QLED - телевизоры',
                    'uz' => 'QLED - телевизоры'
                ],
                'slug' => str_slug('QLED - телевизоры'),
                'position' => 23
            ],
            [
                'name' => [
                    'ru' => '4K UHD - телевизоры',
                    'uz' => '4K UHD - телевизоры'
                ],
                'slug' => str_slug('4K UHD - телевизоры'),
                'position' => 24
            ],
            [
                'name' => [
                    'ru' => 'Full HD - телевизоры',
                    'uz' => 'Full HD - телевизоры'
                ],
                'slug' => str_slug('Full HD - телевизоры'),
                'position' => 25
            ],
            [
                'name' => [
                    'ru' => 'Smart-телевизоры',
                    'uz' => 'Smart-телевизоры'
                ],
                'slug' => str_slug('Smart-телевизоры'),
                'position' => 26
            ],
            [
                'name' => [
                    'ru' => 'Телевизоры Sony',
                    'uz' => 'Телевизоры Sony'
                ],
                'slug' => str_slug('Телевизоры Sony'),
                'position' => 27
            ],
            [
                'name' => [
                    'ru' => 'Телевизоры Samsung',
                    'uz' => 'Телевизоры Samsung'
                ],
                'slug' => str_slug('Телевизоры Samsung'),
                'position' => 28
            ],
            [
                'name' => [
                    'ru' => 'Телевизоры LG',
                    'uz' => 'Телевизоры LG'
                ],
                'slug' => str_slug('Телевизоры LG'),
                'position' => 29
            ]
        ]);

        $category2_2->parents()->createMany([
            [
                'name' => [
                    'ru' => 'Домашние кинотеатры',
                    'uz' => 'Домашние кинотеатры'
                ],
                'slug' => str_slug('Домашние кинотеатры'),
                'position' => 30
            ],
            [
                'name' => [
                    'ru' => 'Акустические системы',
                    'uz' => 'Акустические системы'
                ],
                'slug' => str_slug('Акустические системы'),
                'position' => 31
            ],
            [
                'name' => [
                    'ru' => 'Blu-Ray, DVD и медиаплееры',
                    'uz' => 'Blu-Ray, DVD и медиаплееры'
                ],
                'slug' => str_slug('Blu-Ray, DVD и медиаплееры'),
                'position' => 32
            ],
            [
                'name' => [
                    'ru' => 'Проекторы',
                    'uz' => 'Проекторы'
                ],
                'slug' => str_slug('Проекторы'),
                'position' => 33
            ]
        ]);

        $category3_1 = $category3->parents()->create([
            'name' => [
                'ru' => 'Ноутбуки',
                'uz' => 'Ноутбуки'
            ],
            'slug' => str_slug('Ноутбуки'),
            'popular' => true,
            'image' => 'vendor/site/img/popular_category-icon1.png',
            'position' => 34
        ]);

        $category3_2 = $category3->parents()->create([
            'name' => [
                'ru' => 'Моноблоки',
                'uz' => 'Моноблоки'
            ],
            'slug' => str_slug('Моноблоки'),
            'position' => 35
        ]);

        $category3_3 = $category3->parents()->create([
            'name' => [
                'ru' => 'Комплектующие',
                'uz' => 'Комплектующие'
            ],
            'slug' => str_slug('Комплектующие'),
            'position' => 36
        ]);

        $category3_1->parents()->createMany([
            [
                'name' => [
                    'ru' => 'Ноутбуки-трансформеры',
                    'uz' => 'Ноутбуки-трансформеры'
                ],
                'slug' => str_slug('Ноутбуки-трансформеры'),
                'position' => 37
            ],
            [
                'name' => [
                    'ru' => 'Apple MacBook',
                    'uz' => 'Apple MacBook'
                ],
                'slug' => str_slug('Apple MacBook'),
                'position' => 38
            ],
            [
                'name' => [
                    'ru' => 'Ноутбуки для работы',
                    'uz' => 'Ноутбуки для работы'
                ],
                'slug' => str_slug('Ноутбуки для работы'),
                'position' => 39
            ],
            [
                'name' => [
                    'ru' => 'Игровые ноутбуки',
                    'uz' => 'Игровые ноутбуки'
                ],
                'slug' => str_slug('Игровые ноутбуки'),
                'position' => 40
            ],
            [
                'name' => [
                    'ru' => 'Сумки для ноутбуков',
                    'uz' => 'Сумки для ноутбуков'
                ],
                'slug' => str_slug('Сумки для ноутбуков'),
                'position' => 41
            ]
        ]);

        $category3_2->parents()->createMany([
            [
                'name' => [
                    'ru' => 'Моноблоки Mac',
                    'uz' => 'Моноблоки Mac'
                ],
                'slug' => str_slug('Моноблоки Mac'),
                'position' => 42
            ],
            [
                'name' => [
                    'ru' => 'Моноблоки на Windows',
                    'uz' => 'Моноблоки на Windows'
                ],
                'slug' => str_slug('Моноблоки на Windows'),
                'position' => 43
            ]
        ]);

        $category3_3->parents()->createMany([
            [
                'name' => [
                    'ru' => 'Мониторы',
                    'uz' => 'Мониторы'
                ],
                'slug' => str_slug('Мониторы'),
                'position' => 44
            ],
            [
                'name' => [
                    'ru' => 'Клавиатуры',
                    'uz' => 'Клавиатуры'
                ],
                'slug' => str_slug('Клавиатуры'),
                'position' => 45
            ],
            [
                'name' => [
                    'ru' => 'Компьютерные наушники',
                    'uz' => 'Компьютерные наушники'
                ],
                'slug' => str_slug('Компьютерные наушники'),
                'position' => 46
            ],
            [
                'name' => [
                    'ru' => 'Веб-камеры',
                    'uz' => 'Веб-камеры'
                ],
                'slug' => str_slug('Веб-камеры'),
                'position' => 47
            ],
            [
                'name' => [
                    'ru' => 'Компьютерные мыши',
                    'uz' => 'Компьютерные мыши'
                ],
                'slug' => str_slug('Компьютерные мыши'),
                'position' => 48
            ],
            [
                'name' => [
                    'ru' => 'Компьютерные аксессуары',
                    'uz' => 'Компьютерные аксессуары'
                ],
                'slug' => str_slug('Компьютерные аксессуары'),
                'position' => 49
            ],
            [
                'name' => [
                    'ru' => 'Компьютерные колонки',
                    'uz' => 'Компьютерные колонки'
                ],
                'slug' => str_slug('Компьютерные колонки'),
                'position' => 50
            ],
            [
                'name' => [
                    'ru' => 'Принтеры и сканеры',
                    'uz' => 'Принтеры и сканеры'
                ],
                'slug' => str_slug('Принтеры и сканеры'),
                'position' => 51
            ],
            [
                'name' => [
                    'ru' => 'Комплектующие',
                    'uz' => 'Комплектующие'
                ],
                'slug' => str_slug('Комплектующие'),
                'position' => 52
            ],
            [
                'name' => [
                    'ru' => 'Сетевое оборудование',
                    'uz' => 'Сетевое оборудование'
                ],
                'slug' => str_slug('Сетевое оборудование'),
                'position' => 53
            ]
        ]);

        $category4_1 = $category4->parents()->create([
            'name' => [
                'ru' => 'Фотокамеры',
                'uz' => 'Фотокамеры'
            ],
            'slug' => str_slug('Фотокамеры'),
            'popular' => true,
            'image' => 'vendor/site/img/popular_category-icon3.png',
            'position' => 54
        ]);

        $category4_2 = $category4->parents()->create([
            'name' => [
                'ru' => 'Видеокамеры',
                'uz' => 'Видеокамеры'
            ],
            'slug' => str_slug('Видеокамеры'),
            'position' => 55
        ]);

        $category4_1->parents()->createMany([
            [
                'name' => [
                    'ru' => 'Фотоаппараты компактные',
                    'uz' => 'Фотоаппараты компактные'
                ],
                'slug' => str_slug('Фотоаппараты компактные'),
                'position' => 56
            ],
            [
                'name' => [
                    'ru' => 'Фотоаппараты зеркальные',
                    'uz' => 'Фотоаппараты зеркальные'
                ],
                'slug' => str_slug('Фотоаппараты зеркальные'),
                'position' => 57
            ],
            [
                'name' => [
                    'ru' => 'Фотоаппараты цифровые',
                    'uz' => 'Фотоаппараты цифровые'
                ],
                'slug' => str_slug('Фотоаппараты цифровые'),
                'position' => 58
            ],
            [
                'name' => [
                    'ru' => 'Фотоаксессуары',
                    'uz' => 'Фотоаксессуары'
                ],
                'slug' => str_slug('Фотоаксессуары'),
                'position' => 59
            ]
        ]);

        $category4_2->parents()->createMany([
            [
                'name' => [
                    'ru' => 'Цифровые видеокамеры',
                    'uz' => 'Цифровые видеокамеры'
                ],
                'slug' => str_slug('Цифровые видеокамеры'),
                'position' => 60
            ],
            [
                'name' => [
                    'ru' => 'Экшн-камеры',
                    'uz' => 'Экшн-камеры'
                ],
                'slug' => str_slug('Экшн-камеры'),
                'position' => 61
            ]
        ]);

        $category5_1 = $category5->parents()->create([
            'name' => [
                'ru' => 'Для кухни',
                'uz' => 'Для кухни'
            ],
            'slug' => str_slug('Для кухни'),
            'position' => 62
        ]);

        $category5_2 = $category5->parents()->create([
            'name' => [
                'ru' => 'Для дома',
                'uz' => 'Для дома'
            ],
            'slug' => str_slug('Для дома'),
            'position' => 63
        ]);

        $category5_1->parents()->createMany([
            [
                'name' => [
                    'ru' => 'Холодильники',
                    'uz' => 'Холодильники'
                ],
                'slug' => str_slug('Холодильники'),
                'popular' => true,
                'image' => 'vendor/site/img/popular_category-icon5.png',
                'position' => 64
            ],
            [
                'name' => [
                    'ru' => 'Газовые плиты',
                    'uz' => 'Газовые плиты'
                ],
                'slug' => str_slug('Газовые плиты'),
                'position' => 65
            ],
            [
                'name' => [
                    'ru' => 'Электроплиты',
                    'uz' => 'Электроплиты'
                ],
                'slug' => str_slug('Электроплиты'),
                'position' => 66
            ],
            [
                'name' => [
                    'ru' => 'Микроволновые печи',
                    'uz' => 'Микроволновые печи'
                ],
                'slug' => str_slug('Микроволновые печи'),
                'position' => 67
            ],
            [
                'name' => [
                    'ru' => 'Вытяжки',
                    'uz' => 'Вытяжки'
                ],
                'slug' => str_slug('Вытяжки'),
                'position' => 68
            ],
            [
                'name' => [
                    'ru' => 'Духовые шкафы',
                    'uz' => 'Духовые шкафы'
                ],
                'slug' => str_slug('Духовые шкафы'),
                'position' => 69
            ],
            [
                'name' => [
                    'ru' => 'Мини-печи',
                    'uz' => 'Мини-печи'
                ],
                'slug' => str_slug('Мини-печи'),
                'position' => 70
            ],
            [
                'name' => [
                    'ru' => 'Посудомоечные машины',
                    'uz' => 'Посудомоечные машины'
                ],
                'slug' => str_slug('Посудомоечные машины'),
                'position' => 71
            ],
            [
                'name' => [
                    'ru' => 'Варочные панели',
                    'uz' => 'Варочные панели'
                ],
                'slug' => str_slug('Варочные панели'),
                'position' => 72
            ],
            [
                'name' => [
                    'ru' => 'Морозильники',
                    'uz' => 'Морозильники'
                ],
                'slug' => str_slug('Морозильники'),
                'position' => 73
            ],
            [
                'name' => [
                    'ru' => 'Кулеры для воды',
                    'uz' => 'Кулеры для воды'
                ],
                'slug' => str_slug('Кулеры для воды'),
                'position' => 74
            ]
        ]);

        $category5_2->parents()->createMany([
            [
                'name' => [
                    'ru' => 'Стиральные машины',
                    'uz' => 'Стиральные машины'
                ],
                'slug' => str_slug('Стиральные машины'),
                'position' => 75
            ],
            [
                'name' => [
                    'ru' => 'Пылесосы',
                    'uz' => 'Пылесосы'
                ],
                'slug' => str_slug('Пылесосы'),
                'position' => 76
            ],
            [
                'name' => [
                    'ru' => 'Пароочистители',
                    'uz' => 'Пароочистители'
                ],
                'slug' => str_slug('Пароочистители'),
                'position' => 77
            ],
            [
                'name' => [
                    'ru' => 'Сушильные машины',
                    'uz' => 'Сушильные машины'
                ],
                'slug' => str_slug('Сушильные машины'),
                'position' => 78
            ]
        ]);

        $category6->parents()->createMany([
            [
                'name' => [
                    'ru' => 'Электрочайники',
                    'uz' => 'Электрочайники'
                ],
                'slug' => str_slug('Электрочайники'),
                'position' => 79
            ],
            [
                'name' => [
                    'ru' => 'Фильтры для воды',
                    'uz' => 'Фильтры для воды'
                ],
                'slug' => str_slug('Фильтры для воды'),
                'position' => 80
            ],
            [
                'name' => [
                    'ru' => 'Термопоты',
                    'uz' => 'Термопоты'
                ],
                'slug' => str_slug('Термопоты'),
                'position' => 81
            ],
            [
                'name' => [
                    'ru' => 'Электрические мясорубки',
                    'uz' => 'Электрические мясорубки'
                ],
                'slug' => str_slug('Электрические мясорубки'),
                'position' => 82
            ],
            [
                'name' => [
                    'ru' => 'Мультиварки',
                    'uz' => 'Мультиварки'
                ],
                'slug' => str_slug('Мультиварки'),
                'position' => 83
            ],
            [
                'name' => [
                    'ru' => 'Соковыжималки',
                    'uz' => 'Соковыжималки'
                ],
                'slug' => str_slug('Соковыжималки'),
                'position' => 84
            ],
            [
                'name' => [
                    'ru' => 'Кухонные комбайны',
                    'uz' => 'Кухонные комбайны'
                ],
                'slug' => str_slug('Кухонные комбайны'),
                'position' => 85
            ],
            [
                'name' => [
                    'ru' => 'Тостеры и сэндвичницы',
                    'uz' => 'Тостеры и сэндвичницы'
                ],
                'slug' => str_slug('Тостеры и сэндвичницы'),
                'position' => 86
            ],
            [
                'name' => [
                    'ru' => 'Миксеры и блендеры',
                    'uz' => 'Миксеры и блендеры'
                ],
                'slug' => str_slug('Миксеры и блендеры'),
                'position' => 87
            ],
            [
                'name' => [
                    'ru' => 'Пароварки',
                    'uz' => 'Пароварки'
                ],
                'slug' => str_slug('Пароварки'),
                'position' => 88
            ],
            [
                'name' => [
                    'ru' => 'Хлебопечки',
                    'uz' => 'Хлебопечки'
                ],
                'slug' => str_slug('Хлебопечки'),
                'position' => 89
            ],
            [
                'name' => [
                    'ru' => 'Утюги',
                    'uz' => 'Утюги'
                ],
                'slug' => str_slug('Утюги'),
                'position' => 90
            ],
            [
                'name' => [
                    'ru' => 'Отпариватели',
                    'uz' => 'Отпариватели'
                ],
                'slug' => str_slug('Отпариватели'),
                'position' => 91
            ],
            [
                'name' => [
                    'ru' => 'Швейные машины',
                    'uz' => 'Швейные машины'
                ],
                'slug' => str_slug('Швейные машины'),
                'position' => 92
            ],
            [
                'name' => [
                    'ru' => 'Гладильные доски',
                    'uz' => 'Гладильные доски'
                ],
                'slug' => str_slug('Гладильные доски'),
                'position' => 93
            ],
        ]);

        $category7->parents()->createMany([
            [
                'name' => [
                    'ru' => 'Зубные щётки и центры',
                    'uz' => 'Зубные щётки и центры'
                ],
                'slug' => str_slug('Зубные щётки и центры'),
                'position' => 94
            ],
            [
                'name' => [
                    'ru' => 'Электробритвы',
                    'uz' => 'Электробритвы'
                ],
                'slug' => str_slug('Электробритвы'),
                'position' => 95
            ],
            [
                'name' => [
                    'ru' => 'Эпиляторы',
                    'uz' => 'Эпиляторы'
                ],
                'slug' => str_slug('Эпиляторы'),
                'position' => 96
            ],
            [
                'name' => [
                    'ru' => 'Машинки для стрижки',
                    'uz' => 'Машинки для стрижки'
                ],
                'slug' => str_slug('Машинки для стрижки'),
                'position' => 97
            ],
            [
                'name' => [
                    'ru' => 'Плойки и выпрямители',
                    'uz' => 'Плойки и выпрямители'
                ],
                'slug' => str_slug('Плойки и выпрямители'),
                'position' => 98
            ],
            [
                'name' => [
                    'ru' => 'Фены',
                    'uz' => 'Фены'
                ],
                'slug' => str_slug('Фены'),
                'position' => 99
            ],
            [
                'name' => [
                    'ru' => 'Напольные весы',
                    'uz' => 'Напольные весы'
                ],
                'slug' => str_slug('Напольные весы'),
                'position' => 100
            ],
            [
                'name' => [
                    'ru' => 'Массажёры',
                    'uz' => 'Массажёры'
                ],
                'slug' => str_slug('Массажёры'),
                'position' => 101
            ],
            [
                'name' => [
                    'ru' => 'Тонометры, термометры и ингаляторы',
                    'uz' => 'Тонометры, термометры и ингаляторы'
                ],
                'slug' => str_slug('Тонометры, термометры и ингаляторы'),
                'position' => 102
            ],
            [
                'name' => [
                    'ru' => 'Средства индивидуальной защиты',
                    'uz' => 'Средства индивидуальной защиты'
                ],
                'slug' => str_slug('Средства индивидуальной защиты'),
                'position' => 103
            ]
        ]);
    }
}
