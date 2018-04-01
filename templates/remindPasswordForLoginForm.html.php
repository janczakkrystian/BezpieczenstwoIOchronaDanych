{extends file="templates/globalTemplate.html.php"}
{block name="body"}
<div class = "col-lg-12 col-md-12">
    <div class="col-lg-offset-3 col-lg-6 col-md-offset-3 col-md-6">
        <form class="centered-form" action="http://{$smarty.server.HTTP_HOST}{$subdir}?controller=User&action=remindPasswordForm" method="POST">
            <legend class="text-center text-info">Jeśli zapomniałeś hasła, podaj login do konta</legend>
            <div class="form-group">
                <label for="Login">Login</label>
                <input type="text" class="form-control" id="Login" name="Login" placeholder="Login" required="required"/>
            </div>
            <button type="submit" class="btn btn-success">Przejdź dalej</button>
        </form>
    </div>
</div>
{/block}