#include <bits/stdc++.h> //dia pake libary yang dibutuhin jadi gausah include satu satu
using namespace std;     // ini biar singkat gausah ngetik std::cout << a std::endl;

//deklrarasi
class Tiket{
    private:
        string id_tiket;
        string nama_tiket;
        int jumlah_tiket;
        double harga_tiket;
    public:
        Tiket(){}
        Tiket(string id, string nama, int jumlah, double harga){
            SetID(id);
            SetNama(nama);
            SetJumlah(jumlah);
            SetHarga(harga);
        }

        //setter id
        //const = data konstan jadi bisa buat baca doang
        // & buat referense
        void SetID(const string& id){
            this->id_tiket = id;    //set id
        }
        //setter nama
        void SetNama(const string& nama){
            this->nama_tiket = nama;    //set nama
        }
        //setter jumlah 
        void SetJumlah(const int& jumlah){
            this->jumlah_tiket = jumlah;
        }
        //setter harga
        void SetHarga(const double& harga){
            this->harga_tiket = harga;
        }

        //getter
        // const buar  readonly
        string GetID() const{
            return id_tiket;
        }
        //getter nama
        string GetName() const{
            return nama_tiket;
        }
        string GetNama() const{
            return nama_tiket;
        }
        //getter jumlah
        int GetJumlah() const{
            return jumlah_tiket;
        }
        //getter harga
        double GetHarga() const{
            return harga_tiket;
        }

        //menampilkan data tiket
        void ShowData() const{
            cout << "------------------------" << endl;
            cout << "ID Tiket   : " << id_tiket << endl;
            cout << "Nama Tiket : " << nama_tiket << endl;
            cout << "Jumlah     : " << jumlah_tiket << endl;
            cout << "Harga      : " << fixed << setprecision(0) << harga_tiket << endl;
        }

        //destruktor
        ~Tiket(){}
};
