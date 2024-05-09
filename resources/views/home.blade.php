<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
@include('navbar')
<div class="container mt-4">
    <h1>Parking</h1>
    <p>Our system allows you to register your vehicle for parking services. By registering, you can avail of our
        discount cards for parking.</p>
    <h2>Register Your Vehicle</h2>
    <form id="registerCarForm" action="/api/enter" method="POST">
        <div class="mb-3">
            <label for="vehicleType" class="form-label">Vehicle Type</label>
            <select class="form-control" id="vehicleType">
                <option selected>Choose...</option>
                <option value="Car">Car</option>
                <option value="Bus">Bus</option>
                <option value="Truck">Truck</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="brand" class="form-label">Vehicle Brand</label>
            <input type="text" class="form-control" id="brand" placeholder="Enter vehicle brand">
        </div>
        <div class="mb-3">
            <label for="model" class="form-label">Vehicle Model</label>
            <input type="text" class="form-control" id="model" placeholder="Enter vehicle model">
        </div>
        <div class="mb-3">
            <label for="color" class="form-label">Vehicle Color</label>
            <input type="text" class="form-control" id="color" placeholder="Enter vehicle color">
        </div>
        <div class="mb-3">
            <label for="registration_plate" class="form-label">Vehicle Plate</label>
            <input type="text" class="form-control" id="registration_plate" placeholder="Enter vehicle plate">
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</div>
<footer class="bg-light text-center text-lg-start mt-5">
    <div class="container p-4">
        <h5 class="text-uppercase">Our Business</h5>
        <p>We are a leading provider of parking services, offering convenient and affordable solutions for drivers
            across the city.</p>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById('registerCarForm').addEventListener('submit', function (event) {
        event.preventDefault();
        console.log('Form submitted');
        const data = {
            category: getVehicleCategory(document.getElementById('vehicleType').value),
            brand: document.getElementById('brand').value,
            model: document.getElementById('model').value,
            color: document.getElementById('color').value,
            registration_plate: document.getElementById('registration_plate').value
        };
        fetch(this.action, {
            method: this.method,
            body: JSON.stringify(data),
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
            .then(response => {
                if (response.ok) {
                    return response.json();
                } else {
                    throw new Error('Something went wrong');
                }
            })
            .then(data => {
                // Handle the response data here
                alert('Vehicle registered successfully');
            })
            .catch(error => {
                // Handle the error here
                // alert('An error occurred: ' + error.message);
                console.log(error);
                return error.response.json();  // This returns a Promise
            })
            .then(errorData => {
                console.log(errorData);
            });
    });

    function getVehicleCategory(category) {
        switch (category) {
            case 'Car':
                return 'B';
            case 'Bus':
                return 'D';
            case 'Truck':
                return 'C';
            default:
                return 'Unknown';
        }
    }
</script>
</body>
</html>