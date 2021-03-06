<?php

namespace App\Forms\User;

use App\Core\Form;
use App\Models\User;
use App\Core\Routing\Router;
use App\Core\Constraints\EmailConstraint;
use App\Core\Constraints\LengthConstraint;
use App\Core\Constraints\PasswordConstraint;
use App\Core\Constraints\RequiredConstraint;
use App\Core\Constraints\UniqueConstraint;

class UpdateProfileForm extends Form
{
    public function buildForm()
    {
        $user = $this->model;

        $this->setName("udpateProfileForm");
        
        $this->setBuilder()
            ->add("firstname", "input", [
                "label" => [
                    "value" => "Prénom",
                    "class" => "",
                ],
                "attr" => [
                    "type" => "text",
                    "class" => "form-control form-control-user",
                    "value" => $user->getFirstname()
                ],
                "constraints" => [
                    new RequiredConstraint()
                ]
            ])
            ->add("lastname", "input", [
                "label" => [
                    "value" => "Nom",
                    "class" => "",
                ],
                "required" => true,
                "attr" => [
                    "type" => "text",
                    "class" => "form-control form-control-user",
                    "value" => $user->getLastName()
                ],
                "constraints" => [
                    new RequiredConstraint()
                ]
            ])
            ->add("email", "input", [
                "label" => [
                    "value" => "Email",
                    "class" => "",
                ],
                "required" => true,
                "attr" => [
                    "type" => "email",
                    "class" => "form-control form-control-user",
                    "value" => $user->getEmail()
                ],
                "constraints" => [
                    new EmailConstraint(),
                    new UniqueConstraint("users.email", "L'email est déjà utilisé !", $user->getId()),
                ]
            ])
            ->add("currentPwd", "input", [
                "attr" => [
                    "type" => "password",
                    "class" => "form-control form-control-user",
                    ],
                "label" => [
                    "value" => "Mot de passe",
                    "class" => "",
                ],
                "constraints" => [
                    new PasswordConstraint()
                ]
            ])
            ->add("pwd", "input", [
                "attr" => [
                    "type" => "password",
                    "class" => "form-control form-control-user",
                    ],
                "label" => [
                    "value" => "Nouveau mot de passe",
                    "class" => "",
                ],
                "constraints" => [
                    new PasswordConstraint()
                ]
            ])
            ->add("confirmPwd", "input", [
                "attr" => [
                    "type" => "password",
                    "class" => "form-control form-control-user",
                    ],
                "label" => [
                    "value" => "Confirmation du mot de passe",
                    "class" => "",
                ],
                "constraints" => [
                    new PasswordConstraint()
                ]
            ])
            ->add("annuler", "link", [
                "attr" => [
                    "href" => Router::getRouteByName("home")->getUrl(),
                    "class" => "btn btn-default",
                ],
                "text" => "Annuler",
            ])
            ->add("submit", "input", [
                "attr" => [
                    "type" => "submit",
                    "value" => "Mettre à jour",
                    "class" => "btn btn-primary"
                ]
            ]);
    }

    public function configureOptions(): void
    {
        $this
            ->addConfig("class", User::class)
            ->addConfig("attr", [
                "id" => "udpateProfileForm",
                "class" => "admin-form width-100",
                "name" => "udpateProfileForm"
            ])
            ->addConfig("action", Router::getRouteByName("profile.update")->getUrl());
    }
}