<?php

namespace Sthom\Kernel\Utils;

use Sthom\Kernel\Utils\Repository;

/**
 * Class Security
 * Cette classe fournit des fonctionnalités de sécurité pour la gestion de l'authentification utilisateur.
 * Elle permet de vérifier si un utilisateur est connecté, de le connecter ou de le déconnecter.
 */
class Security
{
    /**
     * Vérifie si l'utilisateur est connecté.
     *
     * Cette méthode examine la session pour voir si la clé `IS_AUTHENTICATED` est définie
     * et si sa valeur est `true`. Si c'est le cas, elle retourne `true`.
     * Sinon, elle retourne `false`.
     *
     * @return bool `true` si l'utilisateur est connecté, sinon `false`.
     *
     * Exemple d'utilisation :
     * ```php
     * if (Security::isConnected()) {
     *     echo "L'utilisateur est connecté.";
     * } else {
     *     echo "L'utilisateur n'est pas connecté.";
     * }
     * ```
     */
    final public static function isConnected(): bool
    {
        // Vérifie si la clé IS_AUTHENTICATED existe dans la session et si sa valeur est `true`.
        if (isset($_SESSION['USER']) && $_SESSION['USER'] instanceof UserInterface) {
            return true;
        }
        // Si les conditions ne sont pas remplies, retourne `false`.
        return false;
    }

    /**
     * Déconnecte l'utilisateur.
     *
     * Cette méthode modifie la clé `USER` de la session pour la définir sur `false`.
     * Cela indique que l'utilisateur n'est plus connecté.
     *
     * @return void
     *
     * Exemple d'utilisation :
     * ```php
     * Security::disconnect();
     * echo "L'utilisateur a été déconnecté.";
     * ```
     */
    final public static function disconnect(): void
    {
        unset($_SESSION['USER']);
        session_destroy();
    }

    /**
     * Authentifie un utilisateur.
     *
     * Cette méthode vérifie si un utilisateur existe dans la base de données et si le mot de passe fourni est correct.
     * Si les deux conditions sont satisfaites, l'utilisateur est connecté et la clé `IS_AUTHENTICATED` est définie à `true`.
     * Sinon, une exception est levée avec un message d'erreur approprié.
     *
     * @param Repository $repository Le repository du modèle contenant les données utilisateur (ex: `new Repository(User::class)`).
     * @param string $column La colonne à utiliser pour vérifier l'utilisateur (ex: `username`).
     * @param string $username La valeur à chercher dans la colonne (ex: `admin`).
     * @param string $password Le mot de passe à vérifier.
     * @return void
     * @throws \Exception Si l'utilisateur n'existe pas ou si le mot de passe est incorrect.
     *
     * Exemple d'utilisation :
     * ```php
     * $repository = new Repository(User::class);
     * try {
     *     Security::authenticate($repository, 'username', 'admin', 'password123');
     *     echo "Authentification réussie.";
     * } catch (\Exception $e) {
     *     echo "Erreur : " . $e->getMessage();
     * }
     * ```
     */
    final public static function authenticate(string $identifier, string $username, string $password): void
    {
        /**
         * Étape 1 : Recherche l'utilisateur dans la base de données.
         * - Utilise le repository pour récupérer un utilisateur où `$column` correspond à `$username`.
         * - `$column` peut être `username`, `email`, ou tout autre champ unique d'authentification.
         */

        if (class_exists($_ENV['MODEL_NAMESPACE'] . 'User') && (in_array(UserInterface::class, class_implements($_ENV['MODEL_NAMESPACE'] . 'User')))) {
            $model = $_ENV['MODEL_NAMESPACE'] . 'User';
            $repository = new Repository($model);
            $result = $repository->getByAttributes([$identifier => $username]);

            if ($result && !empty($result)) {
                $user = $result[0]; // Récupérer le premier et seul utilisateur
                if (password_verify($password, $user->getPassword())) {
                    $_SESSION['USER'] = $user;
                } else {
                    throw new \Exception('Mot de passe incorrect');
                }
            } else {
                // Si aucun utilisateur n'est trouvé, lever une exception.
                throw new \Exception("L'utilisateur n'existe pas");
            }
        } else {
            throw new \Exception("Le modèle d'utilisateur n'existe pas ou n'implémente pas l'interface UserInterface");
        }
    }

    public static function hasRole(array $roles): bool
    {
        if (isset($_SESSION['USER']) && $_SESSION['USER'] instanceof UserInterface) {
            $userRoles = $_SESSION['USER']->getRoles();

            foreach ($roles as $role) {
                if (in_array($role, $userRoles)) {
                    return true;
                }
            }
        }
        return false;
    }
}
