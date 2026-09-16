from Tiket import Tiket


daftarTiket = []

def CekId(id_tiket):
    for i in daftarTiket:
        if i.GetId() == id_tiket:
            return True
    return False

def tambahTiket():
    while True:
        id_tiket = input("Masukkan Id Tiket : ")
        if CekId(id_tiket) == True:
            print("Id Sudah Ada")
        else:
            break
    nama_tiket = input("Masukkan Nama Tiket : ")
    while True:
        jumlah_tiket = int(input("Masukkan Jumlah Tiket : "))
        if jumlah_tiket <= 0:
            print("Jumlah Tidak Boleh Kurang Dari 0")
        else:
            break
    while True:
        harga_tiket = float(input("Masukkan Harga Tiket : "))
        if harga_tiket <= 0:
            print("Harga Tidak Boleh Kurang Dari 0")
        else:
            break
    daftarTiket.append(Tiket(id_tiket, nama_tiket, jumlah_tiket, harga_tiket))
    print("Data berhasil ditambahkan!")

def updateTiket():
    id_tiket = input("Masukkan Id Tiket yang ingin diupdate : ")
    for i in daftarTiket:
        if i.GetId() == id_tiket:
            nama_tiket = input("Masukkan Nama Tiket Baru : ")
            while True:
                jumlah_tiket = int(input("Masukkan Jumlah Tiket Baru : "))
                if jumlah_tiket <= 0:
                    print("Jumlah Tidak Boleh Kurang Dari 0")
                else:
                    break
            while True:
                harga_tiket = float(input("Masukkan Harga Tiket Baru : "))
                if harga_tiket <= 0:
                    print("Harga Tidak Boleh Kurang Dari 0")
                else:
                    break
            i.SetNama(nama_tiket)
            i.SetJumlah(jumlah_tiket)
            i.SetHarga(harga_tiket)
            print("Data berhasil diupdate!")
            return
    print("Data tidak ditemukan!")

def hapusTiket():
    id_tiket = input("Masukkan Id Tiket yang ingin dihapus : ")
    for i in daftarTiket:
        if i.GetId() == id_tiket:
            daftarTiket.remove(i)
            print("Data berhasil dihapus!")
            return
    print("Data tidak ditemukan!")

def cariTiket():
    id_tiket = input("Masukkan Id Tiket yang ingin dicari : ")
    for i in daftarTiket:
        if i.GetId() == id_tiket:
            print("Data ditemukan!")
            print("Id Tiket : ", i.GetId())
            print("Nama Tiket : ", i.GetNama())
            print("Jumlah Tiket : ", i.GetJumlah())
            print("Harga Tiket : ", i.GetHarga())
            return
    print("Data tidak ditemukan!")

def tampilSemua():
    if daftarTiket:
        for i in daftarTiket:
            i.ShowData()
    else:
        print("Data Masih Kosong!")

def menu():
    while True:
        print("="*20)
        print("Menu Tiket")
        print("1. Tambah Tiket")
        print("2. Update Tiket")
        print("3. Hapus Tiket")
        print("4. Cari Tiket")
        print("5. Tampilkan Semua Tiket")
        print("6. Keluar")
        print("="*20)
        pilihan = input("Masukkan Pilihan : ")
        if pilihan == "1":
            tambahTiket()
        elif pilihan == "2":
            updateTiket()
        elif pilihan == "3":
            hapusTiket()
        elif pilihan == "4":
            cariTiket()
        elif pilihan == "5":
            tampilSemua()
        elif pilihan == "6":
            break
        else:
            print("Pilihan Tidak Ada!")

menu()