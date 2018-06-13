{extends file="templates/globalTemplate.html.php"}
{block name="body"}
<div class = "col-lg-12 col-md-12">
<div class="col-lg-offset-3 col-lg-6 col-md-offset-3 col-md-6">
    <form id="logForm" class="centered-form" action="http://{$smarty.server.HTTP_HOST}{$subdir}?controller=Verification&action=verificationForm" method="POST">
        <legend class="text-center text-info" style="margin-top: 15px">Zaloguj się</legend>
        <div class="form-group">
            <label for="Login" style="margin-top: -12px">Login</label>
            <input type="text" class="form-control" id="Login" name="Login" placeholder="Login" minlength="3" maxlength="100" required="required"/>
        </div>
        <div class="form-group">
            <label for="Password">Hasło</label>
            <input type="password" class="form-control" id="Password" name="Password" placeholder="Hasło" minlength="8" maxlength="200" required="required"/>
        </div>
        
		<div class="form-group">
            <div class="g-recaptcha" data-sitekey="6LfuYFYUAAAAAOvlwQY1BoE-9S2DlrLEAn0k1nZZ"></div>
        </div>
		<div class="form-group">
            <button type="submit" class="btn btn-success">Zaloguj</button>
        </div>
        
    </form>
    <span><a href="http://{$smarty.server.HTTP_HOST}{$subdir}?controller=User&action=regForm">Jeśli nie masz konta, zarejestruj się!</a></span>
</div>
</div>
{/block}