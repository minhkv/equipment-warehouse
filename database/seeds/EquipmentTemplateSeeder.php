<?php

use App\Category;
use Illuminate\Database\Seeder;
use App\EquipmentTemplate;
use App\Equipment;
class EquipmentTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $templates = factory(EquipmentTemplate::class, 10)
        //             ->create()
        //             ->each(function($template) {
        //                 $template->equipments()->createMany(factory(Equipment::class, 7)->make()->toArray());
        //             });
        EquipmentTemplate::insert([
            [
                'name' => 'MÁY ẢNH CANON EOS M50', 
                'category_id' => 1,
                'image' => join(DIRECTORY_SEPARATOR, ['/storage', 'img', 'may-anh-canon-eos-m50-kit-1545mm-den(1).jpg'])
            ],
            [
                'name' => 'MÁY ẢNH CANON EOS 3000D', 
                'category_id' => 1,
                'image' => join(DIRECTORY_SEPARATOR, ['/storage', 'img', 'Canon-3000d(1).jpg'])
            ],
            [
                'name' => 'Máy Ảnh Canon PowerShot G7 X Mark II', 
                'category_id' => 1,
                'image' => join(DIRECTORY_SEPARATOR, ['/storage', 'img', 'may-anh-canon-powershot-g7-x-mark-ii1.jpg'])
            ],
            [
                'name' => 'Máy Ảnh Canon EOS 6D Mark II', 
                'category_id' => 1,
                'image' => join(DIRECTORY_SEPARATOR, ['/storage', 'img', 'canon-eos-6d-mark-ii(2).jpg'])
            ],
            [
                'name' => 'Máy Ảnh Canon EOS 800D', 
                'category_id' => 1,
                'image' => join(DIRECTORY_SEPARATOR, ['/storage', 'img', 'canon-eos-800d.jpg'])
            ],
            [
                'name' => 'Máy Ảnh Nikon COOLPIX P1000', 
                'category_id' => 1,
                'image' => join(DIRECTORY_SEPARATOR, ['/storage', 'img', 'Máy Ảnh Nikon COOLPIX P1000.jpg'])
            ],
            [
                'name' => 'Máy Ảnh Nikon D3500 Kit AF-P 18-55 VR', 
                'category_id' => 1,
                'image' => join(DIRECTORY_SEPARATOR, ['/storage', 'img', 'may-anh-nikon-d3500-kit-afp-1855-vr.jpg'])
            ],
            [
                'name' => 'Máy Ảnh Nikon D750', 
                'category_id' => 1,
                'image' => join(DIRECTORY_SEPARATOR, ['/storage', 'img', 'Máy Ảnh Nikon D750.jpg'])
            ],
            [
                'name' => 'Máy Ảnh Nikon D750', 
                'category_id' => 1,
                'image' => join(DIRECTORY_SEPARATOR, ['/storage', 'img', 'nikon-d750-kit-afs-24120-f4-g-ed-vr-hang-nhap-khau.jpg'])
            ],
            [
                'name' => ' Máy Ảnh Nikon D750', 
                'category_id' => 1,
                'image' => join(DIRECTORY_SEPARATOR, ['/storage', 'img', 'may-anh-canon-eos-m50-kit-1545mm-den(1).jpg'])
            ],
            [
                'name' => 'Máy Ảnh Nikon D7500 Kit AF-S DX NIKKOR 18-140 VR', 
                'category_id' => 1,
                'image' => join(DIRECTORY_SEPARATOR, ['/storage', 'img', 'nikon-d7500-kit-afs-dx-nikkor-18140-vr-hang-nhap-khau.jpg'])
            ],
            [
                'name' => 'Máy Ảnh Nikon D850 kit AF-S 24-120 F/4 G ED VR', 
                'category_id' => 1,
                'image' => join(DIRECTORY_SEPARATOR, ['/storage', 'img', 'nikon-d850-kit-afs-24120-f4-g-ed-vr(1).jpg'])
            ],
        ]);
        EquipmentTemplate::insert([
            [
                'name' => 'Máy Quay Sony PXW-FS7M2K', 
                'category_id' => 2,
                'image' => join(DIRECTORY_SEPARATOR, ['/storage', 'img', 'sony-pxwfs7m2k.jpg'])
            ],
            [
                'name' => 'Máy Quay Sony PXW-X320', 
                'category_id' => 2,
                'image' => join(DIRECTORY_SEPARATOR, ['/storage', 'img', 'Máy Quay Sony PXW-X320.jpg'])
            ],
            [
                'name' => 'Máy Quay Sony PXW-Z280 4K', 
                'category_id' => 2,
                'image' => join(DIRECTORY_SEPARATOR, ['/storage', 'img', 'may-quay-sony-pxw-z280.jpg'])
            ],
            [
                'name' => 'MÁY QUAY SONY PMW 300K1', 
                'category_id' => 2,
                'image' => join(DIRECTORY_SEPARATOR, ['/storage', 'img', 'Sony--PMW-300K1-NTSC-va-PAL-jpg.jpg'])
            ],
            [
                'name' => 'Máy Quay Sony PXW-X180', 
                'category_id' => 2,
                'image' => join(DIRECTORY_SEPARATOR, ['/storage', 'img', 'may-quay-sony-pxw-x180.jpg'])
            ],
            [
                'name' => 'Máy Quay Chuyên Dụng Sony PXW-Z190 4K', 
                'category_id' => 2,
                'image' => join(DIRECTORY_SEPARATOR, ['/storage', 'img', 'may-quay-chuyen-dung-sony-pxw-z190-4k(1).jpg'])
            ],
            [
                'name' => 'Máy Quay Sony PXW-Z150 XDCAM', 
                'category_id' => 2,
                'image' => join(DIRECTORY_SEPARATOR, ['/storage', 'img', 'sony-pxwz150.jpg'])
            ],
            [
                'name' => 'Máy Quay Sony HXR-NX5R', 
                'category_id' => 2,
                'image' => join(DIRECTORY_SEPARATOR, ['/storage', 'img', 'sony-hxr-nx5r.jpg'])
            ],
            [
                'name' => 'Máy Quay Sony XDCAM PXW-Z90', 
                'category_id' => 2,
                'image' => join(DIRECTORY_SEPARATOR, ['/storage', 'img', 'may-quay-sony-xdcam-pxwz90.jpg'])
            ],
        ]);
        EquipmentTemplate::insert([
            [
                'name' => 'Máy Ghi Âm Sony ICD-TX650 16GB', 
                'category_id' => 3, 
                'image' => join(DIRECTORY_SEPARATOR, ['/storage', 'img', 'may-ghi-am-sony-icdtx650-16gb-mau-den-4.jpg'])
            ],
            [
                'name' => 'Máy Ghi Âm Sony ICD-UX570F', 
                'category_id' => 3, 
                'image' => join(DIRECTORY_SEPARATOR, ['/storage', 'img', 'may-ghi-am-sony-icd-ux570f.jpg'])
            ],
            [
                'name' => 'Máy Ghi Âm Sony ICD-UX570F', 
                'category_id' => 3, 
                'image' => join(DIRECTORY_SEPARATOR, ['/storage', 'img', 'may-ghi-am-sony-icd-ux570f-bac.jpg'])
            ],
            [
                'name' => 'Máy Ghi Âm Sony ICD-UX533', 
                'category_id' => 3, 
                'image' => join(DIRECTORY_SEPARATOR, ['/storage', 'img', 'may-ghi-am-sony-icdux533.jpg'])
            ],
        ]);
        EquipmentTemplate::insert([
            [
                'name' => 'Chân Máy Velbon M45', 
                'category_id' => 4,
                'image' => join(DIRECTORY_SEPARATOR, ['/storage', 'img', 'chan-may-velbon-m45.jpg'])
            ],
            [
                'name' => 'Chân Máy Benro T880EX', 
                'category_id' => 4,
                'image' => join(DIRECTORY_SEPARATOR, ['/storage', 'img', 'benro-t880ex.jpg'])
            ],
            [
                'name' => 'Chân Máy Velbon M47', 
                'category_id' => 4,
                'image' => join(DIRECTORY_SEPARATOR, ['/storage', 'img', 'chan-may-velbon-m47(1).jpg'])
            ],
            [
                'name' => 'Chân Máy Benro T660EX', 
                'category_id' => 4,
                'image' => join(DIRECTORY_SEPARATOR, ['/storage', 'img', 'benro-t660ex(2).jpg'])
            ],
            [
                'name' => 'Chân Máy Ảnh Slik U873', 
                'category_id' => 4,
                'image' => join(DIRECTORY_SEPARATOR, ['/storage', 'img', 'Chan-may-Slik-U873.jpg'])
            ],
            [
                'name' => 'Chân Máy Benro T800EX', 
                'category_id' => 4,
                'image' => join(DIRECTORY_SEPARATOR, ['/storage', 'img', 'benro-t800ex.jpg'])
            ],
            [
                'name' => 'Chân Máy Velbon EX-630', 
                'category_id' => 4,
                'image' => join(DIRECTORY_SEPARATOR, ['/storage', 'img', 'velbon-ex630.jpg'])
            ],
            [
                'name' => 'Chân Máy Benro Video Tripod KH25', 
                'category_id' => 4,
                'image' => join(DIRECTORY_SEPARATOR, ['/storage', 'img', 'benro-video-tripod-kh25.jpg'])
            ],
        ]);
        
        EquipmentTemplate::insert([
            [
                'name' => 'Đèn Flash Godox TT685C For Canon', 
                'category_id' => 5,
                'image' => join(DIRECTORY_SEPARATOR, ['/storage', 'img', 'tt685c-for-canon.jpg'])
            ],
            [
                'name' => 'Đèn Flash Godox V860II GN60 TTL HSS 1/8000s For Canon', 
                'category_id' => 5,
                'image' => join(DIRECTORY_SEPARATOR, ['/storage', 'img', 'godox-v860ii-gn60-ttl-hss-18000s-cho-canon(4).jpg'])
            ],
            [
                'name' => 'Đèn Flash Godox TT685S For Sony', 
                'category_id' => 5,
                'image' => join(DIRECTORY_SEPARATOR, ['/storage', 'img', 'den-flash-godox-tt685s-for-sony.jpg'])
            ],
            [
                'name' => 'Đèn Flash Godox V860II GN60 TTL HSS 1/8000S For Sony', 
                'category_id' => 5,
                'image' => join(DIRECTORY_SEPARATOR, ['/storage', 'img', 'FLASH-GODOX-V860II-GN60-TTL-HSS-1-8000S-CHO-SONY.jpg'])
            ],
            [
                'name' => 'Đèn Flash Godox TT685N For Nikon', 
                'category_id' => 5,
                'image' => join(DIRECTORY_SEPARATOR, ['/storage', 'img', 'flash-godox-tt685n-for-nikon.jpg'])
            ],
            [
                'name' => 'Đèn Flash Canon Speedlite 470EX-Ai', 
                'category_id' => 5,
                'image' => join(DIRECTORY_SEPARATOR, ['/storage', 'img', 'den-flash-canon-speedlite-470exai-hang-nhap-khau.jpg'])
            ],
            [
                'name' => 'Đèn Flash Godox TT350 For Sony', 
                'category_id' => 5,
                'image' => join(DIRECTORY_SEPARATOR, ['/storage', 'img', 'den-flash-godox-tt350s-for-sony-a7-a7ii-a6000-a6300.jpg'])
            ],
        ]);
        EquipmentTemplate::insert([
            [
                'name' => 'Khung SmallRig Cage For Sony A6500 and A6300 1889', 
                'category_id' => 6,
                'image' => join(DIRECTORY_SEPARATOR, ['/storage', 'img', 'smallrig-cage-for-sony-a6500-and-a6300-1889(1).jpg'])
            ],
            [
                'name' => 'SmallRig Sony A6000/A6300/A6500/ILCE-6300/ILCE-A6500/Nex-7', 
                'category_id' => 6,
                'image' => join(DIRECTORY_SEPARATOR, ['/storage', 'img', 'smallrig-sony-a6300-a6000-ilce-6000-ilce-6300-sony-nex-7-cage-1661.jpg'])
            ],
            [
                'name' => 'SmallRig Cage for Sony A6400 2310', 
                'category_id' => 6,
                'image' => join(DIRECTORY_SEPARATOR, ['/storage', 'img', 'smallrig-cage-for-sony-a6400-2310(1).jpg'])
            ],
            [
                'name' => 'SmallRig Cage For Sony A7RIII/A7M3/A7III (2087)', 
                'category_id' => 6,
                'image' => join(DIRECTORY_SEPARATOR, ['/storage', 'img', 'smallrig-cage-for-sony-a7riii-a7m3-a7iii-2087.jpg'])
            ],
            [
                'name' => 'SmallRig Cage For Canon EOS M50 And M5 2168', 
                'category_id' => 6,
                'image' => join(DIRECTORY_SEPARATOR, ['/storage', 'img', 'smallrig-cage-for-canon-eos-m50-2168.jpg'])
            ],
            [
                'name' => 'SmallRig Half Cage With Arca L-Bracket For Sony A7III A7RIII 2236', 
                'category_id' => 6,
                'image' => join(DIRECTORY_SEPARATOR, ['/storage', 'img', 'smallrig-half-cage-with-arca-l-bracket-for-sony-a7iii-a7riii-2236.jpg'])
            ],
            [
                'name' => 'SmallRig Cage For Nikon D850 2129', 
                'category_id' => 6,
                'image' => join(DIRECTORY_SEPARATOR, ['/storage', 'img', 'smallrig-cage-for-nikon-d850-2129.jpg'])
            ],
        ]);
        EquipmentTemplate::insert([
            [
                'name' => 'Tủ Chống Ẩm Nikatei NC-20C (20 lít)', 
                'category_id' => 7,
                'image' => join(DIRECTORY_SEPARATOR, ['/storage', 'img', 'tu-chong-am-cao-cap-nikatei-nc-20c-20-lit.jpg'])
            ],
            [
                'name' => 'Tủ Chống Ẩm Nikatei NC-30C', 
                'category_id' => 7,
                'image' => join(DIRECTORY_SEPARATOR, ['/storage', 'img', 'tu-chong-am-nikatei-nc30c.jpg'])
            ],
        ]);
        EquipmentTemplate::insert([
            [
                'name' => 'Thẻ Nhớ SDXC Sandisk Extreme Pro 64GB 170MB/s (90MB/s)', 
                'category_id' => 8,
                'image' => join(DIRECTORY_SEPARATOR, ['/storage', 'img', 'the-nho-sdxc-sandisk-extreme-pro-u3-v30-1133x-64gb-sdsdxxy-064g-gn4in-170mb-s.jpg'])
            ],
            [
                'name' => 'Thẻ Nhớ SDXC Sony 64GB 94MB/s (SF-64UX2)', 
                'category_id' => 8,
                'image' => join(DIRECTORY_SEPARATOR, ['/storage', 'img', 'sony-sdhc-uhs1-64gb-sf64ux2.jpg'])
            ],
            [
                'name' => 'Thẻ Nhớ SDXC SanDisk Extreme Pro 128GB 170MB/s', 
                'category_id' => 8,
                'image' => join(DIRECTORY_SEPARATOR, ['/storage', 'img', 'the-nho-sdxc-sandisk-extreme-pro-128gb-170mbs (1).jpg'])
            ],
            [
                'name' => 'Thẻ Nhớ MicroSDHC Sandisk Extreme 32GB 100MB/s (60MB/s)', 
                'category_id' => 8,
                'image' => join(DIRECTORY_SEPARATOR, ['/storage', 'img', 'microsdhc-sandisk-extreme-32gb-100mbs-60mbs.jpg'])
            ],
            [
                'name' => 'Thẻ Nhớ MicroSDHC Lexar 32GB 95MB/45MB/s', 
                'category_id' => 8,
                'image' => join(DIRECTORY_SEPARATOR, ['/storage', 'img', 'the-nho-lexar-32gb-micro-633x-sdhc-95mb45mbs.jpg'])
            ],
            [
                'name' => 'Thẻ Nhớ SDHC Lexar 32GB 95MB/45MB/s (633x)', 
                'category_id' => 8,
                'image' => join(DIRECTORY_SEPARATOR, ['/storage', 'img', 'the-nho-lexar-32gb-pro-633x-sdhc-95mb45mbs.jpg'])
            ],
        ]);
        EquipmentTemplate::insert([
            [
                'name' => 'Dây Cáp SDI Ugreen 10m', 
                'category_id' => 9,
                'image' => join(DIRECTORY_SEPARATOR, ['/storage', 'img', 'day-cap-sdi-ugreen-10m.jpg'])
            ],
        ]);
       
        EquipmentTemplate::insert([
            [
                'name' => 'Pin Sony NP-F970', 
                'category_id' => 10,
                'image' => join(DIRECTORY_SEPARATOR, ['/storage', 'img', 'pin-sony-npf970.jpg'])
            ],
            [
                'name' => 'Pin Sony BP-U60', 
                'category_id' => 10,
                'image' => join(DIRECTORY_SEPARATOR, ['/storage', 'img', 'pin-sony-bpu60.jpg'])
            ],
            [
                'name' => 'Pin Sony BP-U90', 
                'category_id' => 10,
                'image' => join(DIRECTORY_SEPARATOR, ['/storage', 'img', 'sony-bpu90.jpg'])
            ],
            [
                'name' => 'Pin Sony BP-U70', 
                'category_id' => 10,
                'image' => join(DIRECTORY_SEPARATOR, ['/storage', 'img', 'pin-sony-bp-u70.jpg'])
            ],
        ]);
        EquipmentTemplate::insert([
            [
                'name' => 'Sạc I-Discovery FW50', 
                'category_id' => 11,
                'image' => join(DIRECTORY_SEPARATOR, ['/storage', 'img', 'sac-i-discovery-fw50(1).jpg'])
            ],
            [
                'name' => 'Sạc I-Discovery NP-W126', 
                'category_id' => 11,
                'image' => join(DIRECTORY_SEPARATOR, ['/storage', 'img', 'sac-i-discovery-np-w126(2).jpg'])
            ],
            
        ]);
        EquipmentTemplate::insert([
            [
                'name' => 'Túi Canon 521', 
                'category_id' => 12,
                'image' => join(DIRECTORY_SEPARATOR, ['/storage', 'img', 'tui-canon-521.jpg'])
            ],
            [
                'name' => 'Túi Sony A1', 
                'category_id' => 12,
                'image' => join(DIRECTORY_SEPARATOR, ['/storage', 'img', 'bao-may-sony-a1.jpg'])
            ],
            [
                'name' => 'Bao Máy Ảnh Sony 039', 
                'category_id' => 12,
                'image' => join(DIRECTORY_SEPARATOR, ['/storage', 'img', 'bao-may-sony-039.jpg'])
            ],
            [
                'name' => 'Túi Sony RX100', 
                'category_id' => 12,
                'image' => join(DIRECTORY_SEPARATOR, ['/storage', 'img', 'bao-sony-rx100.jpg'])
            ],
            [
                'name' => 'Túi Máy Ảnh Lowepro Format 140', 
                'category_id' => 12,
                'image' => join(DIRECTORY_SEPARATOR, ['/storage', 'img', 'tui-lowepro-format-140.jpg'])
            ],
        ]);
        EquipmentTemplate::insert([
            [
                'name' => 'Dây Đeo Máy Ảnh Canon Digital', 
                'category_id' => 13,
                'image' => join(DIRECTORY_SEPARATOR, ['/storage', 'img', 'day-deo-may-anh-canon-digital.jpg'])
            ],
            [
                'name' => 'Dây Đeo Máy Ảnh Nikon', 
                'category_id' => 13,
                'image' => join(DIRECTORY_SEPARATOR, ['/storage', 'img', 'day-deo-may-anh-nikon.jpg'])
            ],
            [
                'name' => 'Dây Đeo Thao Tác Nhanh Quick Strap Caden K', 
                'category_id' => 13,
                'image' => join(DIRECTORY_SEPARATOR, ['/storage', 'img', 'day-deo-thao-tac-nhanh-quick-strap-caden-k.jpg'])
            ],
        ]);
        $templates = EquipmentTemplate::all();
        foreach($templates as $template) {
            $template->equipments()->createMany(factory(Equipment::class, 7)->make()->toArray());
        }
    }
}
