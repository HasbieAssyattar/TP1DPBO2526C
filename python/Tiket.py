class Tiket:
    
    def __init__(self, id_tiket: str, nama_tiket: str, jumlah_tiket: int, harga_tiket: float):
        # inisiasi
        self.__id_tiket = str(id_tiket)
        self.__nama_tiket = str(nama_tiket)
        self.__jumlah_tiket = int(jumlah_tiket)
        self.__harga_tiket = float(harga_tiket)
        
    # getter
    def GetId(self):
        return self.__id_tiket
    
    def GetNama(self):
        return self.__nama_tiket
    
    def GetJumlah(self):
        return self.__jumlah_tiket
    
    def GetHarga(self):
        return self.__harga_tiket
    
    # getter alias (camelCase)
    getId = GetId
    getNama = GetNama
    getJumlah = GetJumlah
    getHarga = GetHarga
    
    # setter
    def SetId(self, id_tiket):
        self.__id_tiket = str(id_tiket)
        
    def SetNama(self, nama_tiket):
        self.__nama_tiket = str(nama_tiket)
    
    def SetJumlah(self, jumlah_tiket):
        self.__jumlah_tiket = int(jumlah_tiket)
            
    def SetHarga(self, harga_tiket):
        self.__harga_tiket = float(harga_tiket)

    # setter alias (camelCase)
    setId = SetId
    setNama = SetNama
    setJumlah = SetJumlah
    setHarga = SetHarga
            
    # metod show data asek
    def ShowData(self):
        print("------------------------")
        print("ID Tiket   : ", self.GetId())
        print("Nama Tiket : ", self.GetNama())
        print("Jumlah     : ", self.GetJumlah())
        print(f"Harga      : {self.GetHarga():.0f}")

    showData = ShowData