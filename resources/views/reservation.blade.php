<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/purecss@2.1.0/build/pure-min.css" integrity="sha384-yHIFVG6ClnONEA5yB5DJXfW2/KC173DIQrYoZMEtBvGzmf0PKiGyNEqe9N6BNDBH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.2.0/fonts/remixicon.css" rel="stylesheet">
    <title>Reservation</title>
    <style>
        .header {
            background-color: #333;
            padding: 20px;
            position: sticky;
            text-align: center;
            top: 0;
        }
        .footer {
            background-color: #333;
            bottom: 0;
            text-align: center;
        }
        .footer-content {
            display: flex;
            flex-direction: row;
            justify-content: space-evenly;
        }
        .footer-column {
            display: flex;
            flex-direction: column;
            padding: 20px;
            width: 12%;
        }
        .parent-container {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100vh;
        }
        .child-container {
            display: flex;
            flex-direction: column;
            margin: 0 20%;
        }
        .container {
            justify-content: center;
            align-items: center;
        }
        .description {
            margin-top: 36px;
            margin-bottom: 36px;
        }
        .content {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        .column {
            width: 40%;
            margin-bottom: 36px;
        }
        .amount-due {
            margin-top: 36px;
            margin-bottom: 36px;
            font-weight: bold;
            background-color: chartreuse;
            padding: 10px;
        }
        .receipt-item {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }
        .pure-button-primary {
            background-color: #333;
        }
        .content-alignm {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
        }
        .preview {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
        }
        img {
            padding: 10px;
            margin: 10px;
            border: 2px solid #333;
        }
    </style>
</head>
<body>
    <div class="pure-g header">
        <div class="pure-u-1">
            <div class="pure-menu pure-menu-horizontal">
                <a href="#" class="pure-menu-heading pure-menu-link">BROKE STUDENT HOTEL</a>
                <ul class="pure-menu-list">
                    <li class="pure-menu-item"><a href="#" class="pure-menu-link">Home</a></li>
                    <li class="pure-menu-item"><a href="#" class="pure-menu-link">About</a></li>
                    <li class="pure-menu-item"><a href="#" class="pure-menu-link">Contact</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="parent-container">
        <div class="child-container">
            <div class="description">
                <h1>Description</h1>
                <p>We are a hotel that caters to students who are broke. We offer cheap rooms!</p>
            </div>
            <div class="pure-g container">
                <div class="pure-u-1 content">
                    <div class="pure-u-1-3 column">
                        <form class="pure-form pure-form-stacked" method="POST" action="/">
                            @csrf
                            <fieldset>
                                <legend>Reservation</legend>
                                <label for="checkInDate">Check In Date</label>
                                <input id="checkInDate" name="checkInDate" type="date" placeholder="Check In Date">
                                <label for="checkOutDate">Check Out Date</label>
                                <input id="checkOutDate" name="checkOutDate" type="date" placeholder="Check Out Date">
                                <label for="numberOfRooms">Number of Rooms</label>
                                <input id="numberOfRooms" name="numberOfRooms" type="number" placeholder="Number of Rooms">
                            </fieldset>
                            <button type="submit" class="pure-button pure-button-primary">Submit</button>
                        </form>
                    </div>
                    <div class="pure-u-1-3 column">
                        <h3>Receipt</h3>
                        @php ($itemDesc = [
                                "Room Rate Per Day",
                                "Number of Days",
                                "Number of Rooms",
                                "Room Fee",
                                "Discount",
                                "Amount Due"
                            ]
                        )
                        @php ($itemValue = [
                                $roomRate ?? "",
                                $numberOfDays ?? "",
                                $numberOfRooms ?? "",
                                $roomFee ?? "",
                                $discount ?? "",
                                $totalAmount ?? ""
                            ]
                        )

                        @for ($index = 0; $index < count($itemDesc); $index++)
                            @if ($index == count($itemDesc) - 1)
                                <hr class="dashed">
                                <div class="receipt-item amount-due">
                                    <span>{{ $itemDesc[$index] }}</span>
                                    <span>{{ $itemValue[$index] }}</span>
                                </div>
                            @else
                                <div class="receipt-item">
                                    <span>{{ $itemDesc[$index] }}</span>
                                    <span>{{ $itemValue[$index] }}</span>
                                </div>
                            @endif
                        @endfor

                        <h3>Room Preview</h3>
                        <div class="preview">
                            @if (isset($selectedRooms))
                                @foreach ($selectedRooms as $room)
                                    {!! $room !!}
                                @endforeach
                            @else
                                <img src="/placeholder.png" alt="Placeholder Image" width="40%">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="pure-g footer">
            <div class="pure-u-1">
                <div class="pure-menu footer-content">
                    <ul class="pure-menu-list footer-column">
                        <li class="pure-menu-item">
                            <a href="#" class="pure-menu-link content-alignm">
                                <i class="ri-phone-fill"></i>
                                907-200-2853
                            </a>
                        </li>
                        <li class="pure-menu-item">
                            <a href="#" class="pure-menu-link content-alignm">
                                <i class="ri-mail-fill"></i>
                                student@hotel.com
                            </a>
                        </li>
                        <li class="pure-menu-item">
                            <a href="#" class="pure-menu-link content-alignm">
                                <i class="ri-hotel-fill"></i>
                                Cold Drive Way, AK
                            </a>
                        </li>
                    </ul>
                    <!-- copyright info -->
                    <ul class="pure-menu-list footer-column">
                        <li class="pure-menu-item"><a href="#" class="pure-menu-link">© 2020 Broke Student Hotel</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
