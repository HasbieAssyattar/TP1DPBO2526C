import java.util.ArrayList; //import Class ArrayList
import java.util.Locale;    //untuk Locale.US
import java.util.Scanner;   //untuk Class Scanner

public class Main { //class utama
    
    private static ArrayList<Tiket> daftarTiket = new ArrayList<>(); //Array list untuk menampung data
    private static Scanner scanner = new Scanner(System.in).useLocale(Locale.US); //objek Scanner untuk input

    private static boolean cekId(String Id) { //membuat cekId
        for (Tiket produk : daftarTiket) //looping
        {
            if (produk.getId().equals(Id)) //cekId
            {
                return true; //kembalian true jika id ada
            }
        }
        return false; //kembalian false jika id gaada
    }
 
    private static void tambahTiket(Scanner sc){//membuat tambahTiket
        String Id,nama; //variabel
        int jumlah; //variabel
        double harga; //variabel

        do {
            System.out.print("Id       : ");
            Id = sc.nextLine();
            if (cekId(Id)) { //cekId
                System.out.println("Id udah ada ey, ganti!"); //print id sudah ada
            }
        } while (cekId(Id)); //looping
        
        System.out.print("Nama     : "); //print nama
        nama = sc.nextLine();

        do { //do while
            System.out.print("Jumlah   : ");
            jumlah = sc.nextInt();
            if (jumlah <= 0) { //cekjumlah
                System.out.println("jumlah tIdak boleh dibawah 0"); //print jumlah tIdak boleh dibawah 0
            }
        } while (jumlah <= 0);

        do {
            System.out.print("Harga    : ");
            harga = sc.nextDouble();
            if (harga <= 0) { //cekharga
                System.out.println("itu harga apa utang kok mines"); //print harga apa utang
            }
        } while (harga <= 0);

        daftarTiket.add(new Tiket(Id, nama, jumlah, harga)); //menambahkan data ke array list
        System.out.println("Data berhasil ditambahkan!"); //print data berhasil ditambahkan
    }

    private static void updateTiket(Scanner sc){ //membuat updateTiket
        String Id;
        System.out.print("Masukkan Id yang mau diubah : "); //input id
        Id = sc.nextLine();

        for (int i = 0; i < daftarTiket.size(); i++) { //looping
            if (daftarTiket.get(i).getId().equals(Id)) { //cekId
                String nama; //variabel
                int jumlah; //variabel
                double harga;

                System.out.print("Masukkan Nama Baru : ");
                nama = sc.nextLine();
                daftarTiket.get(i).setNama(nama); //mengupdate nama

                System.out.print("Masukkan Jumlah Baru : ");
                jumlah = sc.nextInt();
                daftarTiket.get(i).setJumlah(jumlah); //mengupdate jumlah

                System.out.print("Masukkan Harga Baru : ");
                harga = sc.nextDouble();
                daftarTiket.get(i).setHarga(harga); //mengupdate harga

                System.out.println("Data berhasil diupdate!"); //print data berhasil diupdate
                return; //keluar dari fungsi
            }
        }
        System.out.println("Id gaada loh... pastiin ulang");
    }

    private static void hapusTiket(Scanner sc){ //membuat hapusTiket
        String Id;
        System.out.print("Masukkan Id yang ingin dihapus : "); //input id
        Id = sc.nextLine();

        for (int i = 0; i < daftarTiket.size(); i++) { //looping
            if (daftarTiket.get(i).getId().equals(Id)) { //cekId
                daftarTiket.remove(i); //menghapus data
                System.out.println("Data berhasil dihapus"); //print data berhasil dihapus
                return;
            }
        }
        System.out.println("Id gaada loh... pastiin ulang");
    }

    private static void cariTiket(Scanner sc){ //membuat cariTiket
        String Id;
        System.out.print("Masukkan Id yang ingin dicari : "); //input id
        Id = sc.nextLine();

        for (int i = 0; i < daftarTiket.size(); i++) { //looping
            if (daftarTiket.get(i).getId().equals(Id)) { //cekId
                System.out.println("Data ditemukan!"); //print data ditemukan
                System.out.println("Id       : " + daftarTiket.get(i).getId()); //print id
                System.out.println("Nama     : " + daftarTiket.get(i).getNama()); //print nama
                System.out.println("Jumlah   : " + daftarTiket.get(i).getJumlah()); //print jumlah
                System.out.println("Harga    : " + daftarTiket.get(i).getHarga()); //print harga
                return;
            }
        }
        System.out.println("Id tIdak ditemukan!"); //print id tIdak ditemukan
    }

    private static void tampilSemua(){ //membuat tampilSemua
        System.out.println("Data Tiket : ");
        if (daftarTiket.isEmpty()) { //cek empty
            System.out.println("Data masih kosong!"); //print data masih kosong
            return;
        }
        for (int i = 0; i < daftarTiket.size(); i++) { //looping
            daftarTiket.get(i).ShowData();
        }
    }

    private static void menuTiket(){
        System.out.println("========================");
        System.out.println("Masukkan Menu : ");
        System.out.println("1. Tambah Tiket");
        System.out.println("2. Update Tiket");
        System.out.println("3. Hapus Tiket");
        System.out.println("4. Cari Tiket");
        System.out.println("5. Tampilkan Semua Tiket");
        System.out.println("6. Keluar");
        System.out.println("========================");
        System.out.print("Pilihan : ");
    }

    public static void main(String[] args) {
        int pilihan;
        do {
            menuTiket();
            pilihan = scanner.nextInt();
            scanner.nextLine(); // Membersihkan buffer

            switch (pilihan) { //switch case
                case 1:
                    tambahTiket(scanner); //tambahTiket
                    break;
                case 2:
                    updateTiket(scanner); //updateTiket
                    break;
                case 3:
                    hapusTiket(scanner); //hapusTiket
                    break;
                case 4:
                    cariTiket(scanner); //cariTiket
                    break;
                case 5:
                    tampilSemua(); //tampilSemua
                    break;
                case 6:
                    System.out.println("Keluar..."); //print keluar
                    break;
                default:
                    System.out.println("Pilihan tIdak ada!");
            }
        } while (pilihan != 6); //looping
        scanner.close(); //menutup scanner
    }

}
