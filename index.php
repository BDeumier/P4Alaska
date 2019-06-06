<?php
session_start();
require('controller/controller.php');

try
{
    if (isset($_GET['action']))
    {
        if ($_GET['action'] == 'listPosts')
        {
            listPosts();
        }
        elseif ($_GET['action'] == 'post')
        {
            if (isset($_GET['id']) && $_GET['id'] > 0)
            {
                post();
            }
            else
            {
                throw new Exception('Erreur : aucun identifiant de billet envoyé');
            }
        }

        elseif ($_GET['action'] == 'addComment')
        {
            if(isset($_GET['id']) && $_GET['id'] > 0)
            {
                if (isset($_SESSION['nickname']) && !empty($_POST['comment']))
                {
                    addComment($_GET['id'], $_SESSION['nickname'], $_POST['comment']);
                }
                else
                {
                    throw new Exception('Erreur : tous les champs ne sont pas remplis !');
                }
            }
            else
            {
                throw new Exception('Erreur : aucun identifiant de billet envoyé');
            }
        }

        elseif ($_GET['action'] == 'gologin')
        {
                gologin();
        }

        elseif ($_GET['action'] == 'login')
        {
            if(isset($_POST['nickname']) && isset($_POST['password']))
            {
                login($_POST['nickname'], $_POST['password']);
            }
            else
            {
                throw new Exception('Erreur : l\'identifiant ou le mot de passe ,n\'est pas renseigné'); // même si l'un des 2 n'est pas renseigné on n'a pas ce message d'erreur
            }
        }

        elseif ($_GET['action'] == 'gosignin')
        {
                gosignin();
        }

        elseif ($_GET['action'] == 'signin')
        {
            if(isset($_POST['nickname']) && isset($_POST['passwordA']) && isset($_POST['passwordB'])&& isset($_POST['email']))
            {
                signin($_POST['nickname'], $_POST['passwordA'], $_POST['email']);
            }
            else
            {
                throw new Exception('Erreur : tous les champs ne sont pas renseignés'); // à tester
            }
        }

        elseif ($_GET['action'] == 'logout')
        {
                logout();
        }

        elseif ($_GET['action'] == 'gopromote')
        {
                gopromote();
        }

        elseif ($_GET['action'] == 'promote')
        {
            if(isset($_POST['nickname']))
            {
                if ($_POST['nickname'] == $_POST['nickname2'])
                {
                    promote($_POST['nickname']);                  
                }

                else
                {
                    throw new Exception("Les 2 champs ne sont pas identiques.");                 
                }
            }
            else
            {
                throw new Exception("Veuillez renseigner un pseudonyme.");
                
            }
        }

        elseif ($_GET['action'] == 'gowrite')
        {
            gowrite();
        }

        elseif ($_GET['action'] == 'write')
        {
            if(isset($_POST['postTitle']) && isset($_POST['post']))
            {
                write($_POST['postTitle'], $_POST['post']);
            }
            
            else
            {
                throw new Exception('Erreur : le titre ou le contenu n\'est pas renseigné');
            }
        }

        elseif ($_GET['action'] == 'goeditComment')
        {
            if(isset($_GET['id']) && $_GET['id'] > 0)
            {
                goeditComment($_GET['id']);
            }
            
            else
            {
                throw new Exception('Erreur : aucun identifiant de commentaire envoyé');
            }
        }

        elseif ($_GET['action'] == 'editComment')
        {
            if(isset($_GET['id']) && $_GET['id'] > 0)
            {
                if (isset($_POST['newText']))
                {
                    editComment($_GET['id'], $_POST['newText']);
                }

                else
                {
                    throw new Exception('Erreur : le texte est vide');
                }
            }

            else
            {
                throw new Exception('Erreur : aucun identifiant de commentaire envoyé');
            }
        }

        elseif ($_GET['action'] == 'deleteComment')
        {
            if(isset($_GET['id']) && $_GET['id'] > 0)
            {
                deleteComment($_GET['id']);
            }

            else
            {
                throw new Exception('Erreur : aucun identifiant de commentaire envoyé');
            }
        }

        elseif ($_GET['action'] == 'reportComment')
        {
            if(isset($_GET['id']) && $_GET['id'] > 0)
            {
                reportComment($_GET['id']);
            }

            else
            {
                throw new Exception('Erreur : aucun identifiant de commentaire envoyé');
            }
        }

        elseif ($_GET['action'] == 'deletePost')
        {
            if(isset($_GET['id']) && $_GET['id'] > 0)
            {
                deletePost($_GET['id']);
            }

            else
            {
                throw new Exception('Erreur : aucun identifiant de billet envoyé');
            }
        }
    }
    else
    {
        listPosts();
    }
}

catch(Exception $e)
{
    echo 'Erreur : ' . $e->getMessage();
}