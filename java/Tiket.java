public class Tiket {
    //buat atribur privat
    private String id_tiket;
    private String nama_tiket;
    private int jumlah_tiket;
    private double harga_tiket;

    //buat konstrukteor
    public Tiket(String id_tiket, String nama_tiket, int jumlah_tiket, double harga_tiket){
        this.id_tiket = id_tiket;
        this.nama_tiket = nama_tiket;
        this.jumlah_tiket = jumlah_tiket;
        this.harga_tiket = harga_tiket;
    }

    //getter
    public String getId(){
        return id_tiket;
    }
    public String getNama(){
        return nama_tiket;
    }
    public int getJumlah(){
        return jumlah_tiket;
    }
    public double getHarga(){
        return harga_tiket;
    }

    //setter
    public void setID(String id_tiket){
        this.id_tiket = id_tiket;
    }
    public void setNama(String nama_tiket){
        this.nama_tiket = nama_tiket;
    }
    public void setJumlah(int jumlah_tiket){
        this.jumlah_tiket = jumlah_tiket;
    }
    public void setHarga(double harga_tiket){
        this.harga_tiket = harga_tiket;
    }
    
    void ShowData(){
            System.out.println("------------------------" + getId());
            System.out.println("ID Tiket   : " + getNama());
            System.out.println("Nama Tiket : " + getStok());
            System.out.println("Jumlah     : " + getStok());
            System.out.println("Harga      : %.0f\n",getHarga());
        }
    
}
