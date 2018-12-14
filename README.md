[![Rawsec's CyberSecurity Inventory](https://inventory.rawsec.ml/img/badges/Rawsec-inventoried-FF5050_flat.svg)](https://inventory.rawsec.ml/ctf_platforms.html#CanHackMe)
[![GitHub stars](https://img.shields.io/github/stars/safflower/canhackme.svg)](https://github.com/safflower/canhackme/stargazers)
[![GitHub license](https://img.shields.io/github/license/safflower/canhackme.svg)](https://github.com/safflower/canhackme/blob/master/LICENSE)

# CanHackMe

![main](https://i.imgur.com/8UGyviq.png)

It's jeopardy style wargame website called CanHackMe.

This platform tested on `Ubuntu 16.04` + `Apache 2.4` + `PHP 7.2`.

<https://canhack.me>

---

## How to set it up?

1. Install `Apache 2.4`.
`.htaccess` file is not available with other software.

2. Install `PHP 7`.
Lower versions are not supported.

3. Install `php-sqlite3` and `php-mbstrings` modules.

4. Set permission to access SQLite database file (default: `/@import/canhackme.db`).

5. Modify `/@import/config.php` file.
Make sure to change the hash salt (`__HASH_SALT__`) to a long random string.
Don't make it public.

6. Register an account of administrator at the website.

7. You must access the mysql database directly to add notices and challenges.

