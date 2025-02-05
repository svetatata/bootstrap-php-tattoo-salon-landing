
<?php
session_start();
require 'connect.php';

$stmt = $conn->prepare("SELECT * FROM services");
$stmt->execute();
$services = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
?>


<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Тату Салон</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .header-bg {
            background: url('header-bg.jpg') no-repeat center center/cover;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
        }
        .card {
            border: 0;
        }
        .card-img-top {
            object-fit: contain;
            height: 20vh;
        }
        footer {
            height: 10vh;
        }
        .review-item {
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.8s ease-out, transform 0.8s ease-out;
        }

        .review-item.visible {
            opacity: 1;
            transform: translateY(0);
        }
        .section-with-divider {
        position: relative; 
        }

        .section-with-divider::after {
        content: ""; 
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%); 
        width: 60%;
        height: 2px;
        background-color: black;
        }

        </style>
</head>
<body>
    <nav class="navbar navbar-dark bg-dark navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">Tutu Studio</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="#services">Каталог</a></li>
                <li class="nav-item"><a class="nav-link" href="#reviews">Отзывы</a></li>
                <li class="nav-item"><a class="nav-link" href="#booking">Запись</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="nav-item"><a class="btn btn-outline-light" href="logout.php">Выйти (<?= $_SESSION['name'] ?>)</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="btn btn-outline-light" href="login.php">Вход</a></li>
                <?php endif; ?>
            </ul>
            </div>
        </div>
    </nav>

    <header class="header-bg">
        <div>
            <h1 class="display-2">Добро пожаловать в наш тату салон</h1>
            <p class="lead">Мужские и женские тату, татуаж. Мастера европейского уровня. </p>
            <p class="lead">Современное оборудование. Только качественные материалы. Доступные цены!</p>
        </div>
    </header>

    <section id="services" class="container my-5 section-with-divider">
            <h2 class="text-center">Каталог услуг</h2>
            <div class="row row-cols-1 row-cols-md-2 g-4 mt-3">
                <?php foreach ($services as $service): ?>
                    <div class="col">
                        <div class="card h-100 review-item">
                            <img src="<?= htmlspecialchars($service['icon']) ?>" class="card-img-top" alt="<?= htmlspecialchars($service['name']) ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($service['name']) ?></h5>
                                <p class="card-text"><?= htmlspecialchars($service['description']) ?></p>
                                <p class="fw-bold">От <?= number_format($service['price'], 0, ',', ' ') ?> ₽</p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>


        <section id="reviews" class="container my-5 py-5 section-with-divider" >
    <h2 class="text-center mb-4">Отзывы</h2>

    <div class="row">
        <div class="col-md-3">
            <div class="card p-3 shadow-sm review-item">
                <div class="d-flex align-items-center">
                    <img src="man.jpg" class="rounded-circle me-3 align-self-start" width="50" height="50" alt="Иван">
                    <div>
                        <strong>Иван</strong>
                        <p class="mb-0">Отличный сервис, мастера профессионалы! Приду ещё раз!</p>
                        <img src="tattoo2.jpg" alt="Тату Ивана" class="card-img-top">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 shadow-sm review-item">
                <div class="d-flex align-items-center">
                    <img src="woman.jpg" class="rounded-circle me-3 align-self-start" width="50" height="50" alt="Светлана" >
                    <div>
                        <strong>Светлана</strong>
                        <p class="mb-0">Мастера прекрасные, очень рада, что пришла в этот тату салон!</p>
                        <img src="tattoo1.jpg" alt="Тату Светланы" class="card-img-top">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 shadow-sm review-item">
                <div class="d-flex align-items-center">
                    <img src="man2.jpg" class="rounded-circle me-3 align-self-start" width="50" height="50" alt="Иван">
                    <div>
                        <strong>Миша</strong>
                        <p class="mb-0">Отличный сервис, мастера профессионалы! Приду ещё раз!</p>
                        <img src="tattoo4.jpg" alt="Тату Ивана" class="card-img-top">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 shadow-sm review-item">
                <div class="d-flex align-items-center">
                    <img src="man3.jpg" class="rounded-circle me-3 align-self-start" width="50" height="50" alt="Светлана" >
                    <div>
                        <strong>Никита</strong>
                        <p class="mb-0">Мастера прекрасные, очень рада, что пришла в этот тату салон!</p>
                        <img src="tattoo5.jpg" alt="Тату Светланы" class="card-img-top">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if (isset($_SESSION['user_id'])): ?>
        <a class="btn btn-dark mt-3" href="#">Оставить отзыв</a>
    <?php endif; ?>
</section>
    <section id="booking" class="container my-5">
        <h2 class="text-center">Запись на услугу</h2>
        <?php if (isset($_SESSION['user_id'])): ?>
            <form class="mt-3" action="book.php" method="POST">
                <div class="mb-3">
                    <label class="form-label">Выберите услугу</label>
                    <select class="form-control" name="service_id" required>
                        <?php foreach ($services as $service): ?>
                            <option value="<?= $service['id'] ?>">
                                <?= htmlspecialchars($service['name']) ?> - <?= number_format($service['price'], 0, ',', ' ') ?> ₽
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-dark">Записаться</button>
            </form><br>
            <?php
                    if (isset($_SESSION['message'])) {
                $message = $_SESSION['message'];
                $message_type = $_SESSION['message_type'];

                $alert_class = 'alert-' . ($message_type == 'success' ? 'success' : 'danger');

                echo '<div class="alert ' . $alert_class . '">' . $message . '</div>';

                unset($_SESSION['message']);
                unset($_SESSION['message_type']);
            }
            else echo '<p>После записи мы вам перезвоним и согласуем услугу!</p>';
            ?>
            
        <?php else: ?>
            <p class="text-center">Для записи необходимо <a href="login.php">авторизоваться</a>.</p>
        <?php endif; ?>
    </section>
 
    <footer class="bg-dark text-white text-center py-3">
            <p>&copy; 2025 Tutu Studio</p>
        </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        let reviews = document.querySelectorAll(".review-item");

        function onScroll() {
            reviews.forEach(review => {
                let rect = review.getBoundingClientRect();
                if (rect.top < window.innerHeight - 100) {
                    review.classList.add("visible");
                }
            });
        }

        window.addEventListener("scroll", onScroll);
        onScroll(); 
    });
</script>
</body>
</html>
<?php
$conn->close();
?>