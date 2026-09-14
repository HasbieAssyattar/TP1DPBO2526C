#include "Tiket.cpp"
#include <bits/stdc++.h> //dia pake libary yang dibutuhin jadi gausah include satu satu

using namespace std; // ini biar singkat gausah ngetik std::cout << a std::endl;\

vector<Tiket> daftarTiket;

bool CekId(const string& id) {
  for (int i = 0; i < daftarTiket.size(); i++) {
    if (daftarTiket[i].GetID() == id) {
      return true;
    }
  }
  return false;
}

// Tambah Barang
void tambahTiket() {
  string id;
  string nama;
  int jumlah;
  double harga;

  // input id
  do {
    cout << "ID : ";
    cin >> id;
    if (CekId(id)) {
      cout << "ID udah ada ey, ganti!" << endl;
    }
  } while (CekId(id));

  // input nama
  cout << "Nama : ";
  getline(cin >> ws, nama);

  // input jumlah
  do {
    cout << "Jumlah : ";
    cin >> jumlah;

    if (jumlah <= 0) {
      cout << "jumlah tidak boleh dibawah 0" << endl;
    }
  } while (jumlah <= 0);

  // input harga
  do {
    cout << "Harga : ";
    cin >> harga;

    if (harga <= 0) {
      cout << "itu harga apa utang kok mines" << endl;
    }
  } while (harga <= 0);

  daftarTiket.push_back(Tiket(id, nama, jumlah, harga));
  cout << "Tiket berhasil ditambahkan!" << endl;
}

void updateTiket() {
  string id;
  cout << "Masukkan id yang mau diubah : ";
  cin >> id;

  for (auto &i : daftarTiket) {
    if (i.GetID() == id) {
      string nama;
      int jumlah;
      double harga;

      cout << "Masukkan Nama Baru : ";
      getline(cin >> ws, nama);
      i.SetNama(nama);

      cout << "Masukkan Jumlah Baru : ";
      cin >> jumlah;
      i.SetJumlah(jumlah);

      cout << "Masukkan Harga Baru : ";
      cin >> harga;
      i.SetHarga(harga);

      cout << "Tiket berhasil diupdate!" << endl;
      return;
    }
  }
  cout << "ID gaada loh... pastiin ulang" << endl;
}

void hapusTiket() {
  string id;

  cout << "ID Tiket yang ingin dihapus : ";
  cin >> id;

  for (auto it = daftarTiket.begin(); it != daftarTiket.end(); ++it) {
    if (it->GetID() == id) {
      daftarTiket.erase(it);
      cout << "Data berhasil dihapus" << endl;
      return;
    }
  }
  cout << "Data tidak ditemukan" << endl;
}

void cariTiket() {
  string id;

  cout << "ID Tiket yang ingin dicari : ";
  cin >> id;

  for (const auto &i : daftarTiket) {
    if (i.GetID() == id) {
      cout << "\nData ditemukan!" << endl;
      cout << "ID     : " << i.GetID() << endl;
      cout << "Nama   : " << i.GetNama() << endl;
      cout << "Jumlah : " << i.GetJumlah() << endl;
      cout << "Harga  : " << fixed << setprecision(0) << i.GetHarga() << endl;
      return;
    }
  }
  cout << "ID gaada loh... pastiin ulang" << endl;
}

void tampilSemua() {
  cout << "\n=== Data Tiket ===" << endl;
  if (daftarTiket.empty()) {
    cout << "Data masih kosong bro..." << endl;
    return;
  }

  for (const auto &i : daftarTiket) {
    i.ShowData();
  }
}

void menuTiket() {
  cout << "\n========================" << endl;
  cout << "Masukkan menu : " << endl;
  cout << "1. Tambah Tiket" << endl;
  cout << "2. Update Tiket" << endl;
  cout << "3. Hapus Tiket" << endl;
  cout << "4. Cari Tiket" << endl;
  cout << "5. Tampilkan Semua Tiket" << endl;
  cout << "6. Keluar" << endl;
  cout << "========================" << endl;
  cout << "Pilihan : ";
}

int main() {
  int pilihan;
  do {
    menuTiket();
    cin >> pilihan;
    switch (pilihan) {
    case 1:
      tambahTiket();
      break;
    case 2:
      updateTiket();
      break;
    case 3:
      hapusTiket();
      break;
    case 4:
      cariTiket();
      break;
    case 5:
      tampilSemua();
      break;
    case 6:
      cout << "Program selesai. Sampai jumpa!" << endl;
      exit(0);
      break;
    default:
      cout << "Pilihan tidak ada!" << endl;
    }
  } while (pilihan != 6);
  return 0;
}
