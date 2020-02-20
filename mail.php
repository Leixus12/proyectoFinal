<html>
    <head>
        <title>Hola.</title>
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/login.css"/>
    </head>
    <body>
        <form action="src/action.php" id="main-contact-form" method="post" name="contact-form">
            <div class="col-lg-6 animated animate-from-left" style="opacity:1; left: 0px;">
                <div class="form-group">
                    <label for="nombre">Su nombre(Requerido)</label>
                    <input class="form-control" id="name" name="nombre" placeholder="Nombre" required="" type="text"/>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control" id="subject" name="email" placeholder="Email" required="" type="email"/>
                </div> 
                <div class="form-group">
                    <label for="asunto">Asunto</label>
                    <input class="form-control" id="subject" name="asunto" placeholder="Asunto" required="" type="text"/>
                </div>
            </div>
            <div class="col-lg-6 animated animate-from-right" style="opacity: 1; right: 0px;">
                <div class="form-group">
                    <label for="mensaje">Su mensaje</label>
                    <textarea class="form-control" id="message" name="mensaje" placeholder="Mensaje" required="" rows="8"></textarea>
                </div> 
            </div> 
            <div class="clearfix"></div>
            <div class="text-center">
                <button class="btn btn-primary btn-lg btn-send-msg" type="submit">Enviar Mensaje </button>
            </div> 
        </form>
    </body>
</html>

