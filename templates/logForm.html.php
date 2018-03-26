{extends file="templates/globalTemplate.html.php"}
{block name="body"}
    <form class="col-lg-offset-3 col-lg-6 col-md-offset-3 col-md-6 centered-form">
        <div class="form-group">
            <label for="Login">Login</label>
            <input type="text" class="form-control" id="Login" placeholder="Login"/>
        </div>
        <div class="form-group">
            <label for="Password">Password</label>
            <input type="password" class="form-control" id="Password" placeholder="Password"/>
        </div>
        <button type="submit" class="btn btn-success">Zaloguj</button>
    </form>
    <span><a href="http://{$smarty.server.HTTP_HOST}{$subdir}?controller=User&action=regForm">Jeśli nie masz konta, zarejestruj się.</a><span>
{/block}