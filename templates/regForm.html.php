{extends file="templates/globalTemplate.html.php"}
{block name="body"}
<div class="col-lg-offset-3 col-lg-6 col-md-offset-3 col-md-6 col">
    <form  id="regForm" class="centered-form" action="http://{$smarty.server.HTTP_HOST}{$subdir}?controller=User&action=register" method="POST">
        <legend class="text-center text-info">Zarejestruj się</legend>
        <div class="form-group">
            <label for="FirstName">Imie</label>
            <input type="text" class="form-control" id="FirstName" name="FirstName" placeholder="Imie" required>
        </div>
        <div class="form-group">
            <label for="LastName">Nazwisko</label>
            <input type="text" class="form-control" id="LastName" name="LastName" placeholder="Nazwisko" required>
        </div>
        <div class="form-group">
            <label for="Email">Email</label>
            <input type="email" class="form-control" id="Email" name="Email" placeholder="Email" required>
        </div>
        <div class="form-group">
            <label for="Login">Login</label>
            <input type="text" class="form-control" id="Login" name="Login" placeholder="Login" required>
        </div>
        <div class="form-group">
            <label for="Password">Hasło</label>
            <input type="password" class="form-control" id="Password" name="Password" placeholder="Hasło" required>
        </div>
        <div class="form-group">
            <label for="PasswordAgain">Powtórz hasło</label>
            <input type="password" class="form-control" id="PasswordAgain" name="PasswordAgain" placeholder="Powtórz hasło" required>
        </div>
        <button type="submit" class="btn btn-success">Zarejestruj</button>
    </form>
    <span><a href="http://{$smarty.server.HTTP_HOST}{$subdir}">Jeśli masz już konto, zaloguj się!</a></span>
</div>
{/block}