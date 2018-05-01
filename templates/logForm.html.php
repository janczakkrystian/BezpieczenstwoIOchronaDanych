{extends file="templates/globalTemplate.html.php"}
{block name="body"}
<div class = "col-lg-12 col-md-12">
<div class="col-lg-offset-3 col-lg-6 col-md-offset-3 col-md-6">
    <form id="logForm" class="centered-form" action="http://{$smarty.server.HTTP_HOST}{$subdir}?controller=Verification&action=verificationForm" method="POST">
        <legend class="text-center text-info">Zaloguj się</legend>
        <div class="form-group">
            <label for="Login">Login</label>
            <input type="text" class="form-control" id="Login" name="Login" placeholder="Login" required="required"/>
        </div>
        <div class="form-group">
            <label for="Password">Hasło</label>
            <input type="password" class="form-control" id="Password" name="Password" placeholder="Hasło" required="required"/>
        </div>
        <input type="hidden" id="IP" name="IP" required="required" value="127.0.0.2"/>
        <div class="g-recaptcha" data-sitekey="6LfuYFYUAAAAAOvlwQY1BoE-9S2DlrLEAn0k1nZZ"></div>
        <button type="submit" class="btn btn-success">Zaloguj</button>
    </form>
    <span><a href="http://{$smarty.server.HTTP_HOST}{$subdir}?controller=User&action=regForm">Jeśli nie masz konta, zarejestruj się!</a></span>
</div>
</div>
{/block}
{block name="js"}<script src="http://{$smarty.server.HTTP_HOST}{$subdir}resources/js/logForm.js"></script>{/block}