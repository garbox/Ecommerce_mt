<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Added - Success</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<x-navigation/>
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <!-- Success Alert -->
            <div class="alert alert-success text-center" role="alert">
                <h4 class="alert-heading">Success!</h4>
                <p>User has been successfully added.</p>
                <hr>
                <p class="mb-0">You can now proceed with other tasks or <a href="/orderstatus" class="alert-link">go to your dashboard</a>.</p>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap 5 JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"></script>

</body>
</html>
