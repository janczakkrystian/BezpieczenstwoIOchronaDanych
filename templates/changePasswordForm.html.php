{extends file="templates/globalTemplate.html.php"}
{block name="body"}
<div class = "col-lg-12 col-md-12">
    <div class="col-lg-offset-3 col-lg-6 col-md-offset-3 col-md-6">
        <form class="centered-form" action="http://{$smarty.server.HTTP_HOST}{$subdir}?controller=Verification&action=verificationForm&id[0]=User&id[1]=changedPassword" method="POST">
            <legend class="text-center text-info">Zmiana hasła</legend>
            <div class="form-group">
                <label for="OldPassword">Stare hasło</label>
                <input type="password" class="form-control" id="OldPassword" name="OldPassword" placeholder="Stare hasło" required="required"/>
            </div>
            <div class="form-group">
                <label for="NewPassword">Nowe hasło</label>
                <input type="password" class="form-control" id="NewPassword" name="NewPassword" placeholder="Nowe hasło" required="required"/>
            </div>
            <div class="form-group">
                <label for="NewPasswordAgain">Powtórz nowe hasło</label>
                <input type="password" class="form-control" id="NewPasswordAgain" name="NewPasswordAgain" placeholder="Powtórz nowe hasło" required="required"/>
            </div>
            <button type="submit" class="btn btn-success">Zmień hasło</button>
        </form>
    </div>
</div>
{/block}