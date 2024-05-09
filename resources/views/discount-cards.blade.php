<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discount Cards</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card {
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.15);
        }
        .card-title {
            font-size: 1.5em;
            font-weight: bold;
        }
        .card-text {
            font-size: 1.2em;
        }
        .car-image {
            width: 100%;
            height: auto;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.15);
        }
        .parking-lot-image {
            width: 100%;
            height: auto;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.15);
            margin-top: 20px;
        }
    </style>
</head>
<body>
@include('navbar')
<div class="container mt-4">
    <h1>Discount Cards for Parking</h1>
    <p>These discount cards provide a percentage discount for parking. The type of the card (Silver, Gold, Platinum) determines the discount percentage.</p>
    <img src="path_to_car_image.jpg" alt="Car" class="car-image">
    <div class="row">
        @foreach($discountCards as $index => $card)
            @if($index % 3 == 0 && $index != 0)
    </div>
    <div class="row mt-4">
        @endif
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $card->type }}</h5>
                    <p class="card-text">Discount: {{ $card->discount * 100 }}%</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <img src="path_to_parking_lot_image.jpg" alt="Parking Lot" class="parking-lot-image">
</div>
<footer class="bg-light text-center text-lg-start mt-5">
    <div class="container p-4">
        <h5 class="text-uppercase">Our Business</h5>
        <p>We are a leading provider of parking services, offering convenient and affordable solutions for drivers across the city.</p>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>