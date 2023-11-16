<?php

require_once "Adress.php";

class RndClient
{
    public const FROM_DOCTOR_STR = "От врача";
    public static $FOREIGNER_STR = "Иностранец";
    public static $RUSSIA_STR = "Россия";
    public static $GERMANY_STR = "Германия";
    public static $USA_STR = "США";
    public static $ISRAEL_STR = "Израиль";
    public static $SPAIN_STR = "Испания";
    public static $CHINA_STR = "Китай";
    public static $PASSPORT_RF_STR = "паспорт РФ";
    public static $FOREIGN_DOC_STR = "Иностранный документ";


    private $person_id;
    private $cardNum;
    private $gender;
    private $patientStatus;
    private $country;
    private $placeOfBirth;
    private $region;
    private $fam;
    private $name;
    private $ot;
    private $document;
    private $document_series = '';
    private $document_number = '';
    private $dateofbirth;
    private $email = "";
    private $phone;
    private $isLonely;
    private $registrationDate;
    private $city = '';
    private $street = '';
    private $referralSource = '';
    private $referringDoctor = 'first';


    public function __construct()
    {
#   id -----------------------------------------------------------------------------------------------------------------
        $this->person_id = "29" . rand(4, 5);
        for ($i = 1; $i <= 3; $i++)
        {
            $this->person_id .= rand(0, 9);
        }
#   Номер карты --------------------------------------------------------------------------------------------------------
        $this->cardNum = (rand(1, 9));
        for ($i = 1; $i <= rand(3, 5); $i++)
        {
            $this->cardNum .= (rand(0, 9));
        }

#   Пол ----------------------------------------------------------------------------------------------------------------
        $this->gender = rand(true, false);

#   Статус пациента  ---------------------------------------------------------------------------------------------------
        $patientStatuses = ["Коммерческий", "ОМС", "СМ", "СМ клиники", "А/ДЯ", "ДС"];
        if (rand(0, 10) == 0) $this->patientStatus = self::$FOREIGNER_STR;
        else $this->patientStatus = $patientStatuses[array_rand($patientStatuses)];

#   Страна, Место рождения, Регион, ФИО, Документ, Серия документа, Номер Документа ------------------------------------
        $countries = [self::$GERMANY_STR, self::$USA_STR, self::$ISRAEL_STR, self::$SPAIN_STR, self::$CHINA_STR];
        if ($this->patientStatus == self::$FOREIGNER_STR)
        {
#-----------Иностранец--------------------------------------------------------------------------------------------------
            $this->country = $countries[array_rand($countries)];
            $birthPlacesNotRus = [self::$GERMANY_STR, self::$USA_STR, "Калифорния", "Иерусалим", "Пекин", self::$ISRAEL_STR];
            $this->placeOfBirth = $birthPlacesNotRus[array_rand($birthPlacesNotRus)];
            $this->region = $this->getPlaceofbirth();
            $this->initFIOinostranec();
            $this->document = self::$FOREIGN_DOC_STR;
            $this->document_series = "";
            for ($i = 0; $i < rand(7, 9); $i++) $this->document_number .= rand(0, 9);
        } else
        {
#-----------русский-----------------------------------------------------------------------------------------------------
            $this->country = self::$RUSSIA_STR;
            $birthPlacesRus = ["Москва", "СССР", "Стерлитамак", "Дмитровград", "село Дубки", "Казань",
                "Екатеринбург", "Мурманск", "Севастопль", "Киев", "Ленинградская область"];
            $this->placeOfBirth = $birthPlacesRus[array_rand($birthPlacesRus)];
            $this->region = Adress::getAdressSimple();
            $this->initFIOrus();
            $this->document = self::$PASSPORT_RF_STR;
            for ($i = 0; $i < 4; $i++) $this->document_series .= rand(0, 9);
            for ($i = 0; $i < 6; $i++) $this->document_number .= rand(0, 9);
        }

#   Дата рождения ------------------------------------------------------------------------------------------------------
        $dateOfBirthMass =
            ["01.01.1980", "15.05.1992", "03.07.1985", "20.12.1979", "28.09.1990", "09.07.1982", "15.11.1995",
                "28.05.1987", "03.12.1976", "18.04.1990", "22.09.1985", "27.03.1983", "12.01.1999", "29.08.1975",
                "05.06.1980", "16.12.1992", "21.02.1988", "07.04.1996", "10.10.1981", "14.05.1993", "25.09.1984",
                "01.03.1979", "11.11.1991", "05.07.1987", "29.12.1980", "18.04.1978", "06.08.1995", "09.01.1983",
                "17.11.1990", "21.03.1986", "30.05.1977", "26.09.1989", "04.07.1994", "15.12.1981", "09.11.1997",
                "22.10.1980", "18.04.1996", "07.07.1982", "13.09.1990", "19.11.1985", "02.06.1998", "25.12.1983",
                "10.08.1979", "28.05.1982", "15.10.1991", "05.07.1996", "17.12.1981", "14.09.1998", "28.03.1993",
                "19.07.1986", "09.02.1997", "03.11.1991", "23.05.1984", "30.08.1994", "17.06.1987", "11.12.1982",
                "26.07.1989"];
        $this->dateofbirth = $dateOfBirthMass[array_rand($dateOfBirthMass)];

#   Почта ------------------------------------------------------------------------------------------------------------
        for ($i = 1; $i <= rand(4, 8); $i++)
        {
            $this->email .= chr(rand(97, 122));
        }
        $this->email .= "@";
        $emailDomensMass = ["tymbler.ru", "jandex.ru", "fail.com", "gfail.com"];
        $this->email .= $emailDomensMass[array_rand($emailDomensMass)];

#   Телефон ------------------------------------------------------------------------------------------------------------
        $this->phone = "+7 (9";
        $this->phone .= rand(0, 9) . rand(0, 9) . ") ";
        $this->phone .= rand(0, 9) . rand(0, 9) . rand(0, 9) . " ";
        $this->phone .= rand(0, 9) . rand(0, 9) . " ";
        $this->phone .= rand(0, 9) . rand(0, 9);

#   Одинока ли ---------------------------------------------------------------------------------------------------------
        $loneMass = ["Одиночка", "Не одиночка"];
        $this->isLonely = $loneMass[array_rand($loneMass)];

#   Дата регистрации ---------------------------------------------------------------------------------------------------
        $regDateMass = ["15.10.2023", "20.09.2023", "05.11.2023", "18.08.2023", "25.07.2023", "20.06.2023", "05.03.2023",
            "12.09.2023", "15.11.2023", "08.08.2023", "30.07.2023", "25.05.2023", "10.02.2023", "18.04.2023", "22.10.2023", "14.07.2023",
            "29.09.2023", "25.03.2023", "17.11.2023", "30.08.2023", "19.04.2023", "07.06.2023", "23.09.2023", "11.02.2023", "16.10.2023",
            "28.07.2023", "05.05.2023", "14.06.2023", "02.12.2023", "10.03.2023", "25.04.2023", "16.03.2023", "25.11.2023", "20.08.2023",
            "30.09.2023", "10.04.2023", "22.11.2023", "18.03.2023", "07.07.2023", "21.06.2023", "04.01.2023", "30.04.2023", "15.03.2023",
            "12.12.2023", "18.10.2023", "05.09.2023", "28.08.2023", "10.01.2023", "08.01.2023", "12.01.2023", "28.01.2023", "26.01.2023",
            "03.02.2023", "11.01.2023", "17.02.2023", "18.02.2023", "12.02.2023", "01.02.2023", "15.02.2023", "20.02.2023", "14.02.2023",
            "23.02.2023", "04.03.2023", "12.03.2023", "22.03.2023", "27.03.2023", "29.03.2023", "03.04.2023", "04.04.2023", "05.04.2023",
            "08.04.2023", "02.04.2023", "13.04.2023", "14.04.2023", "11.04.2023", "14.03.2023", "30.03.2023", "15.04.2023", "26.04.2023",
            "24.04.2023", "28.04.2023", "04.05.2023", "07.05.2023", "17.05.2023", "15.05.2023", "18.05.2023", "27.05.2023", "29.05.2023",
            "02.06.2023", "09.06.2023", "15.06.2023", "27.06.2023", "05.06.2023", "04.07.2023", "30.06.2023", "08.07.2023", "06.07.2023",
            "11.07.2023", "07.08.2023", "05.08.2023", "19.08.2023", "24.08.2023", "23.08.2023", "25.08.2023", "10.09.2023", "14.09.2023",
            "13.07.2023", "17.09.2023", "25.09.2023", "24.09.2023", "26.09.2023", "06.10.2023", "09.10.2023", "18.09.2023", "10.10.2023",
            "17.10.2023", "13.10.2023", "20.10.2023", "23.04.2023", "25.10.2023", "30.10.2023", "29.10.2023", "10.11.2023", "11.11.2023"];
        $this->registrationDate = $regDateMass[array_rand($regDateMass)];

#   Города России ---------------------------------------------------------------------------------------------------
        $cityRusMass = ["Майкоп", "Горно-Алтайск", "Уфа", "Улан-Удэ", "Махачкала", "Нальчик", "Петразоводск", "Сыктывкар",
            "Йошкар-Ола", "Саранск", "Якутск", "Владикавказ", "Казань", "Кызыл", "Ижевск", "Абакан", "Грозный",
            "Чебоксары", "Барнаул", "Чита", "Петропавловск-Камчатский", "Краснодар", "Красноярск", "Пермь",
            "Ставрополь", "Хабаровск", "Благовещенск", "Архангельск", "Астрахань", "Белгород", "Брянск", "Владимир",
            "Волгоград", "Вологда", "Воронеж", "Иваново", "Иркутск", "Калининград", "Калуга", "Кемерово", "Киров",
            "Кострома", "Курган", "Курск", "Липецк", "Магадан", "Москва", "Мурманск", "Нижний Новгород",
            "Великий Новгород", "Новосибирск", "Омск", "Оренбург", "Орел", "Пенза", "Псков", "Ростов-на-Дону",
            "Рязань", "Самара", "Саратов", "Южно-Сахалинск", "Екатеринбург", "Смоленск", "Тамбов", "Тверь", "Томск",
            "Тула", "Тюмень", "Ульяновск", "Челябинск", "Ярославль", "Нарьян-Мар", "Ханты-Мансийск", "Анадырь",
            "Салехард", "Биробиджан", "Москва"];

#   Улицы России ---------------------------------------------------------------------------------------------------

        $streetMass = ["ул. Ленина", "ул. Пушкина", "ул. Труда", "ул. Молодогвардейцев", "ул. Кирова", "ул. Вавилова",
            "ул. Павлова", "ул. Семенова", "пр-кт Мира", "ул. Рижская", "ул. Павших революционеров"];

#   Откуда узнали ---------------------------------------------------------------------------------------------------
        $referralSourcesMass = ["из интернета", "ВК", "Телеграм", "Новости", "Знакомые", self::FROM_DOCTOR_STR, "Телевизор", "Из газеты"];
        $this->referralSource = $referralSourcesMass[array_rand($referralSourcesMass)];

#   Откуда узнали ---------------------------------------------------------------------------------------------------
        $referringDoctorsMass = ["Конев А.Г.", "Тверд И.И.", "Швецов П.Р", "Иванов В.В.", "Палкин Р.А.", "Ермолин М.К.",
            "Денисов Д.Ж.", "Пальцев М.В."];
        $this->referringDoctor = $referringDoctorsMass[array_rand($referringDoctorsMass)];
    }

    private function initFIOrus()
    {
        if ($this->getGender())
        {   # русский мужик---------------------------------------------------------------------------------------------
            $mFams = ["Петров", "Егоров", "Михайлов", "Никитин", "Козлов", "Кузнецов", "Павлов",
                "Миронов", "Сидоров", "Кузнецов", "Соколов", "Андреев", "Григорьев", "Смирнов",
                "Новиков", "Ковалев", "Иванов", "Тимофеев", "Штирлиц"
            ];
            $this->fam = $mFams[array_rand($mFams)];

            $mNameRus = ["Алексей", "Дмитрий", "Артем", "Максим", "Петр", "Александр", "Егор", "Даниил", "Марк",
                "Владислав", "Арсений", "Денис", "Степан", "Макс", "Антон", "Владимир", "Николай", "Иван", "Виктор",
                "Андрей", "Глеб"
            ];
            $this->name = $mNameRus[array_rand($mNameRus)];

            $otMass = ["Петрович", "Сергеевич", "Владимирович", "Дмитриевич", "Андреевич", "Александрович", "Игоревич",
                "Артемович", "Алексеевич", "Васильевич", "Павлович", "Моисеевич", "Абрамович", "Мордехаевич"
            ];
            $this->ot = $otMass[array_rand($otMass)];
            # ---------------------------------------------------------------------------------------------русский мужик
        } else
        {   # русская баба----------------------------------------------------------------------------------------------
            $jFams = ["Кузнецова", "Андреева", "Тимофеева", "Иванова", "Соколова", "Козлова", "Петрова",
                "Смирнова", "Новикова", "Михайлова", "Сидорова", "Миронова", "Павлова", "Никитина", "Григорьева",
                "Подошва"
            ];
            $this->fam = $jFams[array_rand($jFams)];

            $jNames = ["Елена", "Мария", "Ирина", "Екатерина", "Ольга", "Виктория", "Анастасия", "Елизавета", "Алиса", "Артемида",
                "Ева", "София", "Александра", "Иванна", "Арина", "Анна", "Татьяна", "Ангелина", "Алена", "Валентина",
                "Психея"
            ];
            $this->name = $jNames[array_rand($jNames)];

            $jOtMass = ["Ивановна", "Александровна", "Сергеевна", "Васильевна", "Денисовна", "Павловна", "Владимировна",
                "Петровна", "Игоревна", "Викторовна", "Артемовна", "Алексеевна", "Андреевна", "Максимовна", "Дмитриевна",
                "Данииловна"
            ];
            $this->ot = $jOtMass[array_rand($jOtMass)];
            # ----------------------------------------------------------------------------------------------русская баба
        }
    }

    private function initFIOinostranec()
    {
        $mNameArab = ["Мухамед", "Абу́ Абдулла́х", "Муха́ммад ибн Муса́"];
        if ($this->getGender())
        {
            switch ($this->country)
            {
                case self::$ISRAEL_STR:
                {
# Еврей мужик-----------------------------------------------------------------------------------------------------------
                    $mFamsEvrey = ["Шнипельсон", "Энштейн"];
                    $this->fam = $mFamsEvrey[array_rand($mFamsEvrey)];
                    $mNameEvrey = ["Изя", "Абрам", "Моня", "Моисей", "Шрага-Гога"];
                    $this->name = $mNameEvrey[array_rand($mNameEvrey)];
                    $mOtEvrey = ["Моисеевич", "Абрамович", "Мордехаевич"];
                    $this->ot = $mOtEvrey[array_rand($mOtEvrey)];
                }
                case self::$USA_STR:
                {
# USA мужик-------------------------------------------------------------------------------------------------------------
                    $mFamsUSA = ["Gonzales", "McCarter", "Wolles"];
                    $this->fam = $mFamsUSA[array_rand($mFamsUSA)];
                    $mNameUSA = ["John (Джон)", "Bill (Билл)", "Jorge (Джордж)"];
                    $this->name = $mNameUSA[array_rand($mNameUSA)];
                    $mOtUSA = ["", "", ""];
                    $this->ot = $mOtUSA[array_rand($mOtUSA)];

                }
                case self::$CHINA_STR:
                {
# Китаец мужик----------------------------------------------------------------------------------------------------------
                    $mFamsChina = ["Li (Ли)", "Si (Си)"];
                    $this->fam = $mFamsChina[array_rand($mFamsChina)];
                    $mNameChina = ["Shao (Шао)", "Chun (Чунь)", "Bao (Бао)", "Vay (Вэй)"];
                    $this->name = $mNameChina[array_rand($mNameChina)];
                    $mOtChina = ["Pin", "", ""];
                    $this->ot = $mOtChina[array_rand($mOtChina)];
                }
                case self::$GERMANY_STR:
                {
# Фриц мужик------------------------------------------------------------------------------------------------------------
                    $mFamsDoych = ["Штирлиц", "Борман", "Ганс", "Фриц"];
                    $this->fam = $mFamsDoych[array_rand($mFamsDoych)];
                    $mNameDoych = ["Бернд", "Бамбер", "Исаак", "Иммануэль", "Радульф"];
                    $this->name = $mNameDoych[array_rand($mNameDoych)];
                    $mOtDoych = ["", "", ""];
                    $this->ot = $mOtDoych[array_rand($mOtDoych)];
                }
                case self::$SPAIN_STR:
                {
# Испанец мужик---------------------------------------------------------------------------------------------------------
                    $mFamsSpanish = ["Гарсия", "Гомес", "Алонсо", "Ромеро"];
                    $this->fam = $mFamsSpanish[array_rand($mFamsSpanish)];
                    $mNameSpanish = ["Амадо", "Агапито", "Альфонсо", "César (Цезарь)", "Эрнесто"];
                    $this->name = $mNameSpanish[array_rand($mNameSpanish)];
                    $mOtSpanish = ["", "", ""];
                    $this->ot = $mOtSpanish[array_rand($mOtSpanish)];
                }
            }
        } else # Женщины иностранные --------------------------------------------------------------------------------------------------
        {
            switch ($this->country)
            {
                case self::$ISRAEL_STR:
                {
# Еврей баба -----------------------------------------------------------------------------------------------------------
                    $jFamsEvrey = ["Вексер", "Мирер", "Оксеншванц"];
                    $this->fam = $jFamsEvrey[array_rand($jFamsEvrey)];
                    $jNameEvrey = ["Айлет", "Кармит", "Лиора", "Орна", "Рут"];
                    $this->name = $jNameEvrey[array_rand($jNameEvrey)];
                    $jOtEvrey = ["", "", ""];
                    $this->ot = $jOtEvrey[array_rand($jOtEvrey)];
                }
                case self::$USA_STR:
                {
# USA баба -------------------------------------------------------------------------------------------------------------
                    $jFamsUSA = ["Мур", "Тэйлор", "Дэвис"];
                    $this->fam = $jFamsUSA[array_rand($jFamsUSA)];
                    $jNameUSA = ["Тиффани", "Тринити", "Эмбер", "Джиллиан"];
                    $this->name = $jNameUSA[array_rand($jNameUSA)];
                    $jOtUSA = ["", "", ""];
                    $this->ot = $jOtUSA[array_rand($jOtUSA)];

                }
                case self::$CHINA_STR:
                {
# Китаец Баба ----------------------------------------------------------------------------------------------------------
                    $jFamsChina = ["Гань ", "Жуй", "Лай"];
                    $this->fam = $jFamsChina[array_rand($jFamsChina)];
                    $jNameChina = ["Джиао", "Айминь", "Зэнзэн", "Фенфанг"];
                    $this->name = $jNameChina[array_rand($jNameChina)];
                    $jOtChina = ["Pin", "", ""];
                    $this->ot = $jOtChina[array_rand($jOtChina)];
                }
                case self::$GERMANY_STR:
                {
# Фриц Баба ------------------------------------------------------------------------------------------------------------
                    $jFamsDoych = ["Bauer (Байер)", "Koch", "Krüger", "Юнг"];
                    $this->fam = $jFamsDoych[array_rand($jFamsDoych)];
                    $jNameDoych = ["Розмари", "Астрид", "Ида", "Тереза"];
                    $this->name = $jNameDoych[array_rand($jNameDoych)];
                    $jOtDoych = ["", "", ""];
                    $this->ot = $jOtDoych[array_rand($jOtDoych)];
                }
                case self::$SPAIN_STR:
                {
# Испанец баба ---------------------------------------------------------------------------------------------------------
                    $jFamsSpanish = ["Alonso (Алонсо)", "Cruz (Крус)", "Vega (Вега)", "Serrano (Серрано)"];
                    $this->fam = $jFamsSpanish[array_rand($jFamsSpanish)];
                    $jNameSpanish = ["Долорес", "Джоса", "Люсия", "Калудия"];
                    $this->name = $jNameSpanish[array_rand($jNameSpanish)];
                    $jOtSpanish = ["", "", ""];
                    $this->ot = $jOtSpanish[array_rand($jOtSpanish)];
                }
            }
        }
    }

    public function getId()
    {
        return $this->person_id;
    }

    public function getCardNum()
    {
        return $this->cardNum;
    }

    public function getFam()
    {
        return $this->fam;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getOt()
    {
        return $this->ot;
    }


    public function getDocument()
    {
        return $this->document;
    }


    public function getDocumentseries()
    {
        return $this->document_series;
    }


    public function getDocumentnumber()
    {
        return $this->document_number;
    }


    public function getDateofbirth()
    {
        return $this->dateofbirth;
    }


    public function getEmail()
    {
        return $this->email;
    }

    public function getPhone()
    {
        return $this->phone;
    }


    public function getPatientstatus()
    {
        return $this->patientStatus;
    }


    /**
     * Одинока ли
     * @return string
     */
    public function isLonely()
    {
        return $this->isLonely;
    }


    public function getRegistrationdate()
    {
        return $this->registrationDate;
    }


    public function getCountry()
    {
        return $this->country;
    }

    public function getRegion()
    {
        return $this->region;
    }


    public function getCity()
    {
        return $this->city;
    }


    public function getStreet()
    {
        return $this->street;
    }

    /**
     * man -true
     * wumen - false
     * @return boolean
     */
    public function getGender()
    {
        return $this->gender;
    }


    public function getPlaceofbirth()
    {
        return $this->placeOfBirth;
    }


    public function getReferralsource()
    {
        return $this->referralSource;
    }

    public function getReferringdoctor()
    {
        return $this->referringDoctor;
    }


}