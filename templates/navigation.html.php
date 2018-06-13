<nav class="navbar navbar-inverse navbar-fixed-top">
    <div>
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="http://{$smarty.server.HTTP_HOST}{$subdir}">Portfel</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
            </ul>
            <ul class="nav navbar-nav navbar-right logowanie">
                {if isset($smarty.session.user)}
                <li>
                    <a class="dropdown-toggle" data-toggle="dropdown">Login: {$smarty.session.user}
                    <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="http://{$smarty.server.HTTP_HOST}{$subdir}?controller=Accounts&action=addform">Dodaj konto</a></li>
                        <li><a href="http://{$smarty.server.HTTP_HOST}{$subdir}?controller=User&action=changePasswordForm">Zmień hasło</a></li>
                        <li><a href="http://{$smarty.server.HTTP_HOST}{$subdir}?controller=Log&action=logs">Zapisane logi</a></li>
                        <li><a href="http://{$smarty.server.HTTP_HOST}{$subdir}?controller=User&action=logout">Wyloguj się</a></li>
                    </ul>
                </li>
                {/if}
            </ul>
        </div>
    </div>
</nav>