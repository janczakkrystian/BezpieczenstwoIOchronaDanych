{extends file="templates/globalTemplate.html.php"}
{block name="body"}
<div class="col-lg-offset-3 col-lg-6 col-md-offset-3 col-md-6 col">
    <form  id="regForm" class="centered-form" action="http://{$smarty.server.HTTP_HOST}{$subdir}?controller=User&action=register" method="POST">
        <legend class="text-center text-info" style="margin-top: 15px">Zarejestruj się</legend>
        <div class="form-group">
            <label for="FirstName" style="margin-top: -12px">Imie</label>
            <input type="text" class="form-control" id="FirstName" name="FirstName" minlength="3" maxlength="30" placeholder="Imie" required>
        </div>
        <div class="form-group">
            <label for="LastName"  style="margin-top: -5px">Nazwisko</label>
            <input type="text" class="form-control" id="LastName" name="LastName" minlength="3" maxlength="100" placeholder="Nazwisko" required>
        </div>
        <div class="form-group">
            <label for="Email" style="margin-top: -5px">Email</label>
            <input type="email" class="form-control" id="Email" name="Email" placeholder="Email" required>
        </div>
        <div class="form-group">
            <label for="Login"style="margin-top: -5px">Login</label>
            <input type="text" class="form-control" id="Login" minlength="3" maxlength="100" name="Login" placeholder="Login" required>
        </div>
        <div class="form-group">
            <label for="Password"style="margin-top: -5px">Hasło</label>
            <input type="password" class="form-control" id="Password" name="Password" minlength="8" maxlength="200"  placeholder="Hasło" required>
        </div>
        <div class="form-group">
            <label for="PasswordAgain"style="margin-top: -5px">Powtórz hasło</label>
            <input type="password" class="form-control" id="PasswordAgain" name="PasswordAgain" minlength="8" maxlength="200" placeholder="Powtórz hasło" required>
        </div>
		<div class="form-group">
            <div class="g-recaptcha" style="margin-top: -5px"data-sitekey="6LfuYFYUAAAAAOvlwQY1BoE-9S2DlrLEAn0k1nZZ"></div>
        </div>
		<div class="form-group">
           <button type="submit" class="btn btn-success" style="margin-top: -5px">Zarejestruj</button>
        </div>
        
        
    </form>
    <span><a href="http://{$smarty.server.HTTP_HOST}{$subdir}">Jeśli masz już konto, zaloguj się!</a></span>
</div>
{/block}