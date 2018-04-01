{extends file="templates/globalTemplate.html.php"}
{block name="body"}
<div class = "col-lg-12 col-md-12">
    <div class="col-lg-offset-3 col-lg-6 col-md-offset-3 col-md-6">
        <form class="centered-form" action="http://{$smarty.server.HTTP_HOST}{$subdir}?controller=User&action=sendPasswordByEmail" method="POST">
            <legend class="text-center text-info">Wpisz kod, przesłany na email, w celu potwierdzenia czynności</legend>
            <div class="form-group">
                <input type="hidden" disabled="disabled" class="form-control" id="Login" name="Login" placeholder="Login" required="required" value="{$login}"/>
            </div>
            <div class="form-group">
                <label for="Password">Kod</label>
                <input type="number" class="form-control" id="Code" name="Code" placeholder="Kod" required="required"/>
            </div>
            <button type="submit" class="btn btn-success">Wygeneruj nowe hasło</button>
        </form>
    </div>
</div>
{/block}