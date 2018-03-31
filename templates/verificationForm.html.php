{extends file="templates/globalTemplate.html.php"}
{block name="body"}
<div class = "col-lg-12 col-md-12">
    <div class="col-lg-offset-3 col-lg-6 col-md-offset-3 col-md-6">
        <form class="centered-form" action="http://{$smarty.server.HTTP_HOST}{$subdir}?controller=User&action=verificationAccount" method="POST">
            <legend class="text-center text-info">Potwierdź dane, wpisując KOD przesłany na email.</legend>
            <div class="form-group">
                <input id="IdUser" name="IdUser" required="required" type="hidden" value="{$smarty.session.idUser}"/>
                <input type="number" class="form-control" id="Code" name="Code" required="required" placeholder="XXXXXXXXXX"/>
            </div>
            <button type="submit" class="btn btn-success">Aktywuj konto</button>
        </form>
        <span><a href="http://{$smarty.server.HTTP_HOST}{$subdir}?controller=User&action=sendCodeAgain&id={$smarty.session.idUser}">Jeśli nie dostałeś kodu, prześlij ponownie!</a></span>
    </div>
</div>
{/block}