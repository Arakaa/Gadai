$(".btn-submit").on("click", function () {
  if (Validation()) $("#myform").submit();
});

function Validation() {
  if (!$("[name=Name]").val()) {
    alert("Nama harus diisi!");
    return false;
  }
  if (!$("[name=NIK]").val()) {
    alert("NIK harus diisi!");
    return false;
  }
  if (!$("[name=PhoneNumber]").val()) {
    alert("Nomor Telepon harus diisi!");
    return false;
  }
  if (!$("[name=Gender]").val()) {
    alert("Jenis Kelamin Telepon harus diisi!");
    return false;
  }
  if (!$("[name=Address]").val()) {
    alert("Alamat Telepon harus diisi!");
    return false;
  }
  if (!$("[name=Email]").val()) {
    alert("Email Telepon harus diisi!");
    return false;
  }
  if (!$("[name=Password]").val()) {
    alert("Password Telepon harus diisi!");
    return false;
  }
  if (!$("[name=ConfirmationPassword]").val()) {
    alert("Konfirmasi Password Telepon harus diisi!");
    return false;
  }

  return true;
}
