<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roda Pião</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            scroll-behavior: smooth;
            background-color: #23002c;
            color: white;
            font-family: 'Verdana', sans-serif; /* Aplica a fonte Poppins */
            font-size: 0.9rem;
        }

        section {
            padding: 60px 0;
        }

        .navbar, .rodape {
            background-color: #23002c;
        }

        .navbar-brand, .nav-link {
            color: white !important;
        }

        .banner {
            background-image: url('banner.png'); /* Substitua pela URL da sua imagem */
            background-size: cover;
            background-position: center;
            height: 400px;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .integrantes img {
            border-radius: 50%;
            width: 150px;
            height: 150px;
        }

        .rodape {
            padding: 20px 0;
        }

        .form-control, .btn-primary {
            background-color: #23002c;
            color: white;
            border: 1px solid white;
        }

        #features {
            background: linear-gradient(to right, #170a4e, #4d183e);
        }

        .features-icon {
            font-size: 3rem;
            color: #fff;
            margin-bottom: 5px;
        }

        .feature-item {
            text-align: center;
            margin-bottom: 30px;
        }

        .feature-item h4 {
            margin-top: 10px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<!-- Menu de navegação -->
<nav class="navbar navbar-expand-lg fixed-top">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="#banner">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#informacoes">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#integrantes">Members</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#contato">Contact</a>
            </li>
        </ul>
    </div>
</nav>

<!-- Banner -->
<section id="banner" class="banner">
    <div class="container">
        <h1>Welcome to <strong>Roda Pião</strong></h1>
        <p>- Development and Technology Solutions for your business -</p>
    </div>
</section>

<!-- Informações -->
<section id="informacoes">
    <div class="container">
        <h2>About us</h2>
        <p>We are a technology company dedicated to creating innovative and customized solutions, driving the success of our clients through high-quality software development and tailored technological strategies. Our results-oriented approach ensures that each project is executed with excellence, meeting specific needs and exceeding expectations.</p>
        <p>With a team of passionate experts who stay updated with the latest market trends, we are committed to providing solutions that not only solve problems but also open new opportunities for growth and efficiency for your business.</p>
    </div>
</section>

<!-- Integrantes -->
<section id="integrantes">
    <div class="container">
        <div class="row justify-content-center mb-4">
            <div class="col-md-3 text-center">
                <img src="diego_sarzi.png" alt="Diego Sarzi" class="rounded-circle">
            </div>
            <div class="col-md-8 d-flex align-items-center">
                <div class="w-100">
                    <h3>Diego Sarzi</h3>
                    <p><i>Full Stack Developer / Sysadmin Linux</i></p>
                    <p>I have also worked in the maintenance area and infra for some years. In love with opensource every day I get better at programming.I have been contributing to the Debian project for some time now and have developed an independent distribution called Mazon Os.</p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mb-4">
            <div class="col-md-3 text-center">
                <img src="rafaela_sarzi.png" alt="Rafaela Justino" class="rounded-circle">
            </div>
            <div class="col-md-8 d-flex align-items-center">
                <div class="w-100">
                    <h3>Rafaela Justino</h3>
                    <p><i>Full Stack Developer / Scrum Master</i></p>
                    <p>Developer with experience in Front-End and Back-End, with emphasis on project leadership. Has advanced knowledge in HTML, CSS, JavaScript and PHP. Looking for new challenges and opportunities for professional growth.</p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mb-4">
            <div class="col-md-3 text-center">
                <img src="hooper_santos.png" alt="Hooper Santos" class="rounded-circle">
            </div>
            <div class="col-md-8 d-flex align-items-center">
                <div class="w-100">
                    <h3>Hooper Santos</h3>
                    <p><i>Designer / UX / Developer</i></p>
                    <p>Valuable member of our team, specialized in Design, UX and Development. Combines skills in graphic design and front-end development to create intuitive and functional interfaces. Known for its ability to transform concepts into practical solutions, ensuring a fluid and attractive user experience.</p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mb-4">
            <div class="col-md-3 text-center">
                <img src="rodrigo_locatelli.jpg" alt="Hooper Santos" class="rounded-circle" width="199px">
            </div>
            <div class="col-md-8 d-flex align-items-center">
                <div class="w-100">
                    <h3>Rodrigo Locatelli</h3>
                    <p><i>Product Owner (PO) / Digital Marketing (Google Tools)</i></p>
                    <p>Quick definition and prioritization of the backlog, ease of aligning interested parties, quick and effective decision making that translates requirements into user stories. Expertise in Google Ads for paid campaigns, Google Analytics for data analysis, and Google Tag Manager (GTM) for tag management and tracking.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features -->
<section id="features">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4 text-center">
                        <i class="fab fa-aws features-icon"></i>
                        <h4>AWS</h4>
                    </div>
                    <div class="col-md-4 text-center">
                        <i class="fab fa-google features-icon"></i>
                        <h4>Google Cloud</h4>
                    </div>
                    <div class="col-md-4 text-center">
                        <i class="fab fa-php features-icon"></i>
                        <h4>PHP</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4 text-center">
                        <i class="fab fa-js-square features-icon"></i>
                        <h4>JavaScript</h4>
                    </div>
                    <div class="col-md-4 text-center">
                        <i class="fab fa-python features-icon"></i>
                        <h4>Python</h4>
                    </div>
                    <div class="col-md-4 text-center">
                        <i class="fab fa-node features-icon"></i>
                        <h4>Node.js</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contato -->
<section id="contato">
    <div class="container">
        <h2>Contact</h2>
        <p>Contact us using the information below.</p>
        <form method="POST" action="send-email.php">
            <div class="form-group">
                <label for="nome">Name:</label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Your name">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Your email">
            </div>
            <div class="form-group">
                <label for="mensagem">Message:</label>
                <textarea class="form-control" id="mensagem" rows="3" name="mensagem" placeholder="Your message"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Send</button>
        </form>
    </div>
</section>

<!-- Rodapé -->
<footer class="rodape text-center">
    <div class="container">
        <p>© 2024 Roda Pião. All rights reserved.</p>
    </div>
</footer>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function(){
        $('a.nav-link').on('click', function(event) {
            if (this.hash !== "") {
                event.preventDefault();
                var hash = this.hash;
                $('html, body').animate({
                    scrollTop: $(hash).offset().top - 70
                }, 800, function(){
                    window.location.hash = hash;
                });
            }
        });
    });
</script>

</body>
</html>