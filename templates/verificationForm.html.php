{extends file="templates/globalTemplate.html.php"}
{block name="body"}
<div class = "col-lg-12 col-md-12">
    <div class="col-lg-offset-3 col-lg-6 col-md-offset-3 col-md-6">
        <form id="verificationForm" class="centered-form" action="http://{$smarty.server.HTTP_HOST}{$subdir}?controller=Verification&action=verification" method="POST" style="margin-top: 15px">
            <legend class="text-center text-info">Potwierdź czynność, wpisując KOD przesłany na email.</legend>
            <div class="form-group">
                <input id="IdUser" name="IdUser" required="required" type="hidden" value="{if isset($smarty.session.idUser)}{$smarty.session.idUser}{elseif isset($IdUser)}{$IdUser}{/if}"/>
                <input type="number" style="margin-top: -7px" class="form-control" id="Code" name="Code" required="required" placeholder="XXXXXXXXXX"/>
            </div>
            <button type="submit" class="btn btn-success">Potwierdź</button>
        </form>
        <span><a href="http://{$smarty.server.HTTP_HOST}{$subdir}">Wróć</a></span>
    </div>
</div>
{/block}