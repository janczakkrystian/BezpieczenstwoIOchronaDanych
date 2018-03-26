{extends file="templates/globalTemplate.html.php"}
{block name="body"}
<div class="col-lg-offset-3 col-lg-6 col-md-offset-3 col-md-6 col centered-form">
    <form action="http://{$smarty.server.HTTP_HOST}{$subdir}?controller=User&action=register" method="POST">
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
            <label for="Password">Password</label>
            <input type="password" class="form-control" id="Password" name="Password" placeholder="Password" required>
        </div>
        <button type="submit" class="btn btn-success">Zarejestruj</button>
        <a class="btn btn-primary" href="http://{$smarty.server.HTTP_HOST}{$subdir}">Zaloguj</a>
    </form>
</div>
{/block}