<?php
//on créé la session ici car c'est le point d'entrée du site
session_start();
require('controller/controller.php');

//on récupère l'action demandée par l'utilisateur
try
{
    if (isset($_GET['action']))
    {
        if ($_GET['action'] == 'post')
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
                throw new Exception('Erreur : l\'identifiant ou le mot de passe ,n\'est pas renseigné');
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
                if(preg_match('#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#', $_POST['email']))
                {
                    if($_POST['passwordA'] == $_POST['passwordB'])
                    {
                        signin($_POST['nickname'], $_POST['passwordA'], $_POST['email']);
                    }
                        else
                    {
                        throw new Exception('Erreur : les 2 mots de passe ne sont pas identiques');
                    }
                }
                else
                {
                    throw new Exception("Erreur : adresse mail invalide");
                    
                }   
            }
            else
            {
                throw new Exception('Erreur : tous les champs ne sont pas renseignés');
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

        elseif ($_GET['action'] == 'goeditPost')
        {
            if(isset($_GET['id']) && $_GET['id'] > 0)
            {
                goeditPost($_GET['id']);
            }

            else
            {
                throw new Exception('Erreur : aucun identifiant de billet envoyé');
            }
        }

        elseif ($_GET['action'] == 'editPost')
        {
            if(isset($_POST['newTitle']) && isset($_POST['newText']))
            {
                if(isset($_GET['id']) && $_GET['id'] > 0)
                {
                    editPost($_GET['id'], $_POST['newTitle'], $_POST['newText']);
                }

                else
                {
                throw new Exception('Erreur : aucun identifiant de billet envoyé');
                }
            }

            else
            {
                throw new Exception("Le titre ou le texte n'est pas renseigné");
                
            }
        }

        elseif ($_GET['action'] == 'listPosts')
        {
            if(isset($_GET['page']) && $_GET['page'] > 0)
            {
                listPosts($_GET['page']);
            }

            else
            {
                throw new Exception("La page demandée n'existe pas");       
            }
        }
    }
    //si l'utilisateur n'a pas demandé d'action, on affiche la page d'accueil
    else
    {
        listPosts();
    }
}

//on affiche le message d'erreur si elle a été catch
catch(Exception $e)
{
    echo 'Erreur : ' . $e->getMessage();
}