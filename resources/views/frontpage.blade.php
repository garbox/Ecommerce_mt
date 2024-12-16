<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Tables</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .banner {
            background-image: url('{{asset('storage/monogram_walnut_dining_room_table.jpg')}}'); /* Replace with your banner image URL */
            background-size: cover;
            background-position: center;
            height: 600px;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        .dark{
            background-color: black;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
  <!-- Navbar -->
  <x-navigation/>
  <div class="banner">
  </div>
    <!-- Product Grid -->
    <div class="container my-5">
        <div class="row">
            <section id="about" class="container my-5">
                <h2 class="text-center mb-4">About Modern Tables</h2>
                <p>At Modern Tables, we specialize in crafting exquisite, high-end furniture  that is designed by you to elevate the aesthetic of any home or office. Our collection includes stunning dining room tables, elegant credenzas, sophisticated nightstands, and much more—each piece built with unparalleled craftsmanship and attention to detail.</p>
                <p>Our semi-custom approach allows you to select from a curated range of premium materials, finishes, and design elements, enabling you to create furniture that perfectly suits your unique style and space. Whether you're drawn to sleek modern lines or timeless, traditional designs, we offer a variety of options that allow for personalization without sacrificing quality or craftsmanship.</p>
                <p>Each item is made to order by skilled artisans, ensuring that every piece meets our exacting standards for both beauty and durability. We take pride in using only the finest materials, from rich hardwoods to luxurious metals, guaranteeing a lasting investment in furniture that will be cherished for years to come.</p>
                <p>At Modern Tables, we believe that furniture is more than just functional—it’s an expression of your personality and lifestyle. Our commitment to delivering exceptional, semi-custom designs ensures that your home or office will be filled with pieces that combine both form and function seamlessly. Whether you're furnishing a modern loft or a classic home, we are here to help you create a space that reflects your individuality.</p>
                <p>Discover the difference of craftsmanship with Modern Tables, where luxury meets personalized design in every piece.</p>
        
            </section>
        </div>
    </div>
<!-- Footer -->
<x-footer />
  <!-- Bootstrap JS & Popper.js -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
<!-- Cron job is working -->