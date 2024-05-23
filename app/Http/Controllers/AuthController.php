<?php

namespace App\Http\Controllers;

use App\Models\Credential;
use App\Models\Dealer;
use App\Models\Dinas;
use App\Models\PasswordResetToken;
use App\Models\Mitra;
use Illuminate\Validation\Rules\Password;

use SendGrid\Mail\Mail;

class AuthController extends Controller
{

    public function loginView()
    {
        if (session('user')) {
            return redirect("/");
        }
        return view('auth.login');
    }
    public function registerView()
    {
        if (session('user')) {
            return redirect("/");
        }
        if (request()->has("role") && (request()->role == "dealer" || request()->role == "mitra")) {
            return view('auth.register-' . request()->role);
        }
        return view('auth.select-role');
    }
    public function lupaPasswordView()
    {
        if (session('user')) {
            return redirect("/");
        }
        return view('auth.lupa-password');
    }
    public function resetPasswordView($token)
    {
        if (PasswordResetToken::where(["token" => $token])->first()) {
            return view("auth.reset-password", ["token" => $token]);
        }
        return redirect("/lupa-password");
    }
    public function akunView()
    {
        if (session('user')) {
            $akun = [];
            if (session('user')["role"] === "dealer") {
                $akun = Dealer::where(["credential_id" => session('user')["id"]])->first();
            } else if (session('user')["role"] === "mitra") {
                $akun = Mitra::where(["credential_id" => session('user')["id"]])->first();
            } else if (session("user")["role"] === "dinas") {
                $akun = Dinas::where(["credential_id" => session('user')["id"]])->first();
            }
            $user = Credential::where(["id" => session('user')["id"]])->first();
            session(['user' => $user]);
            return view('auth.akun', ["akun" => $akun, "isOwner" => true, "user" => session("user")]);
        }
        return redirect("/");
    }
    public function profile($role, $id)
    {
        $akun = [];
        if ($role === "dealer") {
            $akun = Dealer::find($id);
            if ($akun) {
                $user = Credential::where(["id" => $akun->credential_id])->first();
            }
        } else if ($role === "mitra") {
            $akun = Mitra::where(["id" => $id])->first();
            if ($akun) {
                $user = Credential::where(["id" => $akun->credential_id])->first();
            }
        } else if ($role === "dinas") {
            $akun = Dinas::where(["id" => $id])->first();
            if ($akun) {
                $user = Credential::where(["id" => $akun->credential_id])->first();
            }
        }
        if (!$akun) {
            return redirect("/");
        }
        return view('auth.akun', ["akun" => $akun, "isOwner" => false, "role" => $role, "user" => $user]);
    }
    public function akunEditView()
    {
        if (session('user')) {
            $akun = [];
            if (session('user')["role"] === "dealer") {
                $akun = Dealer::where(["credential_id" => session('user')["id"]])->first();
            } else if (session('user')["role"] === "mitra") {
                $akun = Mitra::where(["credential_id" => session('user')["id"]])->first();
            } else if (session("user")["role"] === "dinas") {
                $akun = Dinas::where(["credential_id" => session('user')["id"]])->first();
            }
            return view('auth.akun-edit', ["akun" => $akun]);
        }
        return redirect("/");
    }
    public function login()
    {
        request()->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        $credentials = request()->only('username', 'password');
        $user = Credential::where($credentials)->first();
        if ($user) {
            session(['user' => $user]);
            return redirect("/");
        }
        return redirect()->back()->with('invalid', ["message" => 'Username atau Password Salah!'])->withInput();
    }
    public function registerUser()
    {
        if (!request()->has("role") || (request()->role !== "dealer" && request()->role !== "mitra")) {
            return redirect("/register");
        }
        if (request()->role === "dealer") {
            return $this->registerDealer();
        }
        return $this->registerMitra();
    }
    private function registerDealer()
    {
        request()->validate([
            'username' => 'required|unique:credentials',
            'password' => ['required', 'alpha_num', Password::min(2)->letters()->numbers()],
            'nama_dealer' => 'required',
            'telepon_dealer' => 'required|numeric',
            'email_dealer' => 'required|email',
            'alamat_dealer' => 'required',
            'surat_izin_distribusi' => 'required|mimes:pdf',
            'foto_ktp' => 'required|mimes:jpg,jpeg,png',
            'pas_foto_dealer' => 'required|mimes:jpg,jpeg,png',
            'informasi_dealer' => 'required',
            'riwayat_kerjasama' => 'required'
        ]);

        $suratIzin = request()->file("surat_izin_distribusi")->store("surat-izin", "public");
        $fotoKtp = request()->file("foto_ktp")->store("foto-ktp", "public");
        $pasFoto = request()->file("pas_foto_dealer")->store("pas-foto", "public");
        $credentials = request()->only('username', 'password');
        $userData = request()->only("nama_dealer", "telepon_dealer", "email_dealer", "alamat_dealer", "surat_izin_distribusi", "informasi_dealer", "riwayat_kerjasama");

        $credentials['email'] = $userData["email_dealer"];
        $credentials['role'] = "dealer";
        $userData["foto_ktp"] = $fotoKtp;
        $userData["pas_foto_dealer"] = $pasFoto;
        $userData["surat_izin_distribusi"] = $suratIzin;

        $user = Credential::create($credentials);
        $userData["credential_id"] = $user->id;
        Dealer::create($userData);

        session(['user' => $user]);
        return redirect("/")->with("success", "Registrasi berhasil");
    }
    private function registerMitra()
    {
        request()->validate([
            'username' => 'required|unique:credentials',
            'password' => ['required', 'alpha_num', Password::min(2)->letters()->numbers()],
            'nama_pimpinan_perusahaan' => 'required',
            'nama_perusahaan' => 'required',
            'telepon_perusahaan' => 'required|numeric',
            'email_perusahaan' => 'required|email',
            'alamat_perusahaan' => 'required',
            'nomor_induk_berusaha' => 'required|regex:/^[\d -.]+$/',
            'npwp' => 'required|regex:/^[\d -.]+$/',
            'akta' => 'required|mimes:pdf',
            'surat-pernyataan' => 'required|mimes:pdf',
            'surat-izin' => 'required|mimes:pdf',
            'informasi_perusahaan' => 'required'
        ]);

        $akta = request()->file('akta')->store("akta", "public");
        $suratPernyataan = request()->file("surat-pernyataan")->store("surat-pernyataan", "public");
        $suratIzin = request()->file("surat-izin")->store("surat-izin", "public");
        $credentials = request()->only('username', 'password');
        $userData = request()->only("nama_pimpinan_perusahaan", "nama_perusahaan", "telepon_perusahaan", "email_perusahaan", "alamat_perusahaan", "nomor_induk_berusaha", "npwp", "informasi_perusahaan");

        $credentials['email'] = $userData["email_perusahaan"];
        $credentials['role'] = "mitra";
        $userData["akta_perusahaan"] = $akta;
        $userData["surat_pernyataan_usaha_perseorangan"] = $suratPernyataan;
        $userData["surat_izin_usaha_produksi_benih"] = $suratIzin;

        $credential = Credential::create($credentials);
        $userData["credential_id"] = $credential->id;
        Mitra::create($userData);

        session(['user' => $credential]);
        return redirect("/")->with("success", "Registrasi berhasil");
    }
    public function logout()
    {
        session()->forget('user');
        return redirect("/");
    }
    public function resetPassword($token)
    {
        request()->validate([
            'email' => 'required|email',
            'password' => ['required', 'alpha_num', Password::min(2)->letters()->numbers()]
        ]);
        $credentials = request()->only("email", "password");
        $resetToken = PasswordResetToken::where(["token" => $token, "email" => $credentials["email"]])->first();
        if ($resetToken) {
            $user = Credential::where(["email" => $credentials["email"]])->first();
            $user->update(["password" => $credentials["password"]]);
            return redirect("/login");
        }
        return redirect()->back()->with("failed", "credential not valid");
    }
    public function akunEdit()
    {
        if (!session('user')) {
            return redirect("/login");
        }
        if (session('user')["role"] === "admin") {
            return $this->akunEditAdmin();
        } else if (session('user')["role"] === "dinas") {
            return $this->akunEditDinas();
        } else if (session('user')["role"] === "dealer") {
            return $this->akunEditDealer();
        } else if (session('user')["role"] === "mitra") {
            return $this->akunEditMitra();
        }
    }
    public function akunEditAdmin()
    {
        request()->validate([
            'username' => 'required|unique:credentials,username,' . session("user")["id"],
            'password' => ['required', 'alpha_num', Password::min(2)->letters()->numbers()]
        ]);
        $credentials = request()->only("username", "password");
        $user = session("user");
        $user->update($credentials);
        return redirect("/akun")->with("success", "Data berhasil diubah!");
    }
    public function akunEditDinas()
    {
        request()->validate([
            'username' => 'required|unique:credentials,username,' . session("user")["id"],
            'password' => ['required', 'alpha_num', Password::min(2)->letters()->numbers()],
            'nama_dinas' => 'required',
            'alamat_dinas' => 'required',
            'email_dinas' => 'required|email',
            'telepon_dinas' => 'required|regex:/^[\d -]+$/',
            'informasi_dinas' => 'required',
            'foto_dinas' => 'mimes:jpg,jpeg,png'
        ]);
        $credentials = request()->only('username', 'password');
        $userData = request()->only(
            "nama_dinas",
            "alamat_dinas",
            "email_dinas",
            "telepon_dinas",
            "informasi_dinas"
        );
        if (request()->file("foto_dinas")) {
            $fotoDinas = request()->file("foto_dinas")->store("foto-dinas", "public");
            $userData["foto_dinas"] = $fotoDinas;
        }

        $credentials['email'] = $userData["email_dinas"];
        $credentials['role'] = "dinas";
        $user = Credential::where(["id" => session("user")["id"]])->first();

        $userData["credential_id"] = $user->id;
        Dinas::where(["credential_id" => $user->id])->update($userData);
        $user->update($credentials);

        return redirect("/akun")->with("success", "Data berhasil diubah!");
    }
    public function akunEditDealer()
    {
        request()->validate([
            'username' => 'required|unique:credentials,username,' . session("user")["id"],
            'password' => ['required', 'alpha_num', Password::min(2)->letters()->numbers()],
            'nama_dealer' => 'required',
            'telepon_dealer' => 'required|numeric',
            'email_dealer' => 'required|email',
            'alamat_dealer' => 'required',
            'surat_izin_distribusi' => 'mimes:pdf',
            'foto_ktp' => 'mimes:jpg,jpeg,png',
            'pas_foto_dealer' => 'mimes:jpg,jpeg,png',
            'informasi_dealer' => 'required',
            'riwayat_kerjasama' => 'required'
        ]);
        $userData = request()->only("nama_dealer", "telepon_dealer", "email_dealer", "alamat_dealer", "surat_izin_distribusi", "informasi_dealer", "riwayat_kerjasama");
        if (request()->file("surat_izin_distribusi")) {
            $suratIzin = request()->file("surat_izin_distribusi")->store("surat-izin", "public");
            $userData["surat_izin_distribusi"] = $suratIzin;
        }
        if (request()->file("foto_ktp")) {
            $fotoKtp = request()->file("foto_ktp")->store("foto-ktp", "public");
            $userData["foto_ktp"] = $fotoKtp;
        }
        if (request()->file("pas_foto_dealer")) {
            $pasFoto = request()->file("pas_foto_dealer")->store("pas-foto", "public");
            $userData["pas_foto_dealer"] = $pasFoto;
        }

        $credentials = request()->only('username', 'password');
        $credentials['email'] = $userData["email_dealer"];
        $credentials['role'] = "dealer";
        $user = Credential::where(["id" => session("user")["id"]])->first();

        Dealer::where(["credential_id" => $user->id])->update($userData);
        $user->update($credentials);

        return redirect("/akun")->with("success", "Data berhasil diubah!");
    }
    public function akunEditMitra()
    {
        request()->validate([
            'username' => 'required|unique:credentials,username,' . session("user")["id"],
            'password' => ['required', 'alpha_num', Password::min(2)->letters()->numbers()],
            'nama_pimpinan_perusahaan' => 'required',
            'nama_perusahaan' => 'required',
            'telepon_perusahaan' => 'required|numeric',
            'email_perusahaan' => 'required|email',
            'alamat_perusahaan' => 'required',
            'nomor_induk_berusaha' => 'required|regex:/^[\d -.]+$/',
            'npwp' => 'required|regex:/^[\d -.]+$/',
            'akta' => 'mimes:pdf',
            'surat-pernyataan' => 'mimes:pdf',
            'surat-izin' => 'mimes:pdf',
            'informasi_perusahaan' => 'required'
        ]);
        $userData = request()->only("nama_pimpinan_perusahaan", "nama_perusahaan", "telepon_perusahaan", "email_perusahaan", "alamat_perusahaan", "nomor_induk_berusaha", "npwp", "informasi_perusahaan");
        if (request()->file("akta")) {
            $akta = request()->file('akta')->store("akta", "public");
            $userData["akta_perusahaan"] = $akta;
        }
        if (request()->file("surat-pernyataan")) {
            $suratPernyataan = request()->file("surat-pernyataan")->store("surat-pernyataan", "public");
            $userData["surat_pernyataan_usaha_perseorangan"] = $suratPernyataan;
        }
        if (request()->file("surat-izin")) {
            $suratIzin = request()->file("surat-izin")->store("surat-izin", "public");
            $userData["surat_izin_usaha_produksi_benih"] = $suratIzin;
        }

        $credentials = request()->only('username', 'password');
        $credentials['email'] = $userData["email_perusahaan"];
        $credentials['role'] = "mitra";
        $user = Credential::where(["id" => session("user")["id"]])->first();

        Mitra::where(["credential_id" => $user->id])->update($userData);
        $user->update($credentials);

        return redirect("/akun")->with("success", "Data berhasil diubah!");
    }
    public function buatToken()
    {
        $credentials = request()->only('email');
        $token = base64_encode(bin2hex(random_bytes(32)));
        PasswordResetToken::create([
            'email' => $credentials['email'],
            'token' => $token
        ]);
        $email = new Mail();
        $email->setFrom("evianitary26@gmail.com", "Mapseed");
        $email->setSubject("MapSeed Reset Password");
        $email->addTo($credentials['email']);
        $email->addContent("text/html", view("auth.email", ["url" => url("/reset-password/" . $token)])->render());
        $sendgrid = new \SendGrid("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");
        try {
            $sendgrid->send($email);
        } catch (\Exception $e) {
            redirect()->back()->with('invalid', 'Token gagal dibuat');
        }
        return redirect()->back()->with('success', 'Token berhasil dibuat');
    }
}
