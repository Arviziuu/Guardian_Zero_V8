from flask import Blueprint, render_template, redirect, url_for, request, flash, session
from flask_login import login_user, logout_user, login_required, current_user
from app.models import db, Usuario
from app.helpers import (
    hash_password, verify_password,
    generate_reset_token, verify_reset_token
)

auth_bp = Blueprint("auth", __name__, url_prefix="/auth")


@auth_bp.route("/login", methods=["GET", "POST"])
def login():
    if current_user.is_authenticated:
        return redirect(url_for("dashboard.index"))

    if request.method == "POST":
        email    = request.form.get("email", "").strip()
        password = request.form.get("password", "")
        usuario  = Usuario.query.filter_by(Email=email).first()

        if not usuario or not verify_password(usuario.Contraseña, password):
            flash("Correo o contraseña incorrectos.", "error")
            return render_template("auth/login.html")

        login_user(usuario)
        return redirect(url_for("dashboard.index"))

    return render_template("auth/login.html")


@auth_bp.route("/register", methods=["GET", "POST"])
def register():
    if current_user.is_authenticated:
        return redirect(url_for("dashboard.index"))

    if request.method == "POST":
        nombre   = request.form.get("nombre", "").strip()
        email    = request.form.get("email", "").strip()
        telefono = request.form.get("telefono", "").strip()
        password = request.form.get("password", "")
        confirm  = request.form.get("confirm_password", "")

        if not nombre or not email or not password:
            flash("Todos los campos obligatorios deben completarse.", "error")
            return render_template("auth/register.html")

        if password != confirm:
            flash("Las contraseñas no coinciden.", "error")
            return render_template("auth/register.html")

        if len(password) < 8:
            flash("La contraseña debe tener al menos 8 caracteres.", "error")
            return render_template("auth/register.html")

        if Usuario.query.filter_by(Email=email).first():
            flash("Ya existe una cuenta con ese correo electrónico.", "error")
            return render_template("auth/register.html")

        nuevo = Usuario(
            Nombre     = nombre,
            Email      = email,
            Telefono   = telefono or None,
            Contraseña = hash_password(password),
            Rol        = "Civil"
        )
        db.session.add(nuevo)
        db.session.commit()

        flash("¡Cuenta creada exitosamente! Ahora puedes iniciar sesión.", "success")
        return redirect(url_for("auth.login"))

    return render_template("auth/register.html")


@auth_bp.route("/logout")
@login_required
def logout():
    logout_user()
    flash("Sesión cerrada correctamente.", "info")
    return redirect(url_for("auth.login"))


@auth_bp.route("/forgot-password", methods=["GET", "POST"])
def forgot_password():
    if request.method == "POST":
        from app import mail
        from flask_mail import Message
        import traceback

        email   = request.form.get("email", "").strip().lower()
        usuario = Usuario.query.filter_by(Email=email).first()

        if not usuario:
            flash("Si ese correo está registrado, recibirás un enlace en breve.", "info")
            return redirect(url_for("auth.forgot_password"))

        token  = generate_reset_token(email)
        enlace = url_for("auth.reset_verify_token", token=token, _external=True)

        html_body = f"""
        <!DOCTYPE html>
        <html lang="es">
        <body style="margin:0;padding:0;background:#dde8ec;font-family:'Segoe UI',Arial,sans-serif;">
          <table width="100%" cellpadding="0" cellspacing="0">
            <tr>
              <td align="center" style="padding:40px 16px;">
                <table width="480" cellpadding="0" cellspacing="0"
                       style="background:#e8f0f3;border-radius:14px;overflow:hidden;">
                  <tr>
                    <td style="background:#B6C3C9;padding:22px 32px;text-align:center;">
                      <h1 style="margin:0;font-size:1.4rem;font-weight:700;color:#1a3a4a;">
                        GUARDIAN ZERO
                      </h1>
                    </td>
                  </tr>
                  <tr>
                    <td style="padding:36px 32px 28px;">
                      <h2 style="margin:0 0 16px;font-size:1.1rem;color:#1a3a4a;">
                        Recuperación de contraseña
                      </h2>
                      <p style="margin:0 0 10px;color:#4a6475;font-size:.95rem;line-height:1.6;">
                        Hola, <strong style="color:#1a3a4a;">{usuario.Nombre}</strong>.
                      </p>
                      <p style="margin:0 0 24px;color:#4a6475;font-size:.9rem;line-height:1.6;">
                        Recibimos una solicitud para restablecer la contraseña de tu cuenta.
                        Haz clic en el botón de abajo. Este enlace expira en
                        <strong>30 minutos</strong>.
                      </p>
                      <table cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                          <td align="center" style="padding:8px 0 24px;">
                            <a href="{enlace}"
                               style="display:inline-block;background:#1a9ea8;color:#ffffff;
                                      text-decoration:none;padding:14px 36px;border-radius:10px;
                                      font-size:1rem;font-weight:600;">
                              Restablecer contraseña
                            </a>
                          </td>
                        </tr>
                      </table>
                      <p style="margin:0 0 8px;color:#8a9eaa;font-size:.78rem;">
                        Si el botón no funciona, copia este enlace:
                      </p>
                      <p style="margin:0 0 24px;word-break:break-all;">
                        <a href="{enlace}" style="color:#1a9ea8;font-size:.78rem;">{enlace}</a>
                      </p>
                      <hr style="border:none;border-top:1px solid rgba(26,107,115,.15);margin:0 0 20px;"/>
                      <p style="margin:0;color:#8a9eaa;font-size:.78rem;line-height:1.5;">
                        Si no solicitaste este cambio, ignora este correo.
                      </p>
                    </td>
                  </tr>
                  <tr>
                    <td style="background:rgba(26,107,115,.08);padding:14px 32px;
                               text-align:center;color:#8a9eaa;font-size:.75rem;">
                      © Guardian Zero — Sistema de Gestión de Emergencias
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </body>
        </html>
        """

        msg = Message(
            subject    = "Guardian Zero – Recuperación de contraseña",
            recipients = [email],
            html       = html_body
        )

        try:
            mail.send(msg)
            flash("Te enviamos un enlace de recuperación. Revisa tu bandeja de entrada (y spam).", "success")
        except Exception as e:
            # Imprimir el traceback COMPLETO en consola para diagnóstico
            print("=" * 60)
            print("[MAIL ERROR COMPLETO]")
            traceback.print_exc()
            print("=" * 60)
            # Mostrar error específico en pantalla para depuración
            flash(f"Error al enviar correo: {type(e).__name__}: {str(e)}", "error")

        return redirect(url_for("auth.forgot_password"))

    return render_template("auth/forgot_password.html")


@auth_bp.route("/reset/<token>", methods=["GET"])
def reset_verify_token(token):
    email = verify_reset_token(token)
    if not email:
        flash("El enlace expiró o es inválido. Solicita uno nuevo.", "error")
        return redirect(url_for("auth.forgot_password"))

    session["verified_reset_email"] = email
    flash("Enlace verificado. Ingresa tu nueva contraseña.", "info")
    return redirect(url_for("auth.reset_password"))


@auth_bp.route("/reset-password", methods=["GET", "POST"])
def reset_password():
    email = session.get("verified_reset_email")
    if not email:
        flash("Sesión de recuperación inválida. Inicia el proceso de nuevo.", "error")
        return redirect(url_for("auth.forgot_password"))

    if request.method == "POST":
        password = request.form.get("password", "")
        confirm  = request.form.get("confirm_password", "")

        if len(password) < 8:
            flash("La contraseña debe tener al menos 8 caracteres.", "error")
            return render_template("auth/reset_password.html")

        if password != confirm:
            flash("Las contraseñas no coinciden.", "error")
            return render_template("auth/reset_password.html")

        usuario = Usuario.query.filter_by(Email=email).first()
        if not usuario:
            flash("Usuario no encontrado.", "error")
            return redirect(url_for("auth.login"))

        usuario.Contraseña = hash_password(password)
        db.session.commit()
        session.pop("verified_reset_email", None)

        flash("¡Contraseña actualizada exitosamente! Ya puedes iniciar sesión.", "success")
        return redirect(url_for("auth.login"))

    return render_template("auth/reset_password.html")