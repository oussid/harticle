<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'first_name' => 'Magnets',
                'last_name' => 'Media',
                'profile_picture' => 'https://yt3.ggpht.com/qbB9LSY1cRIM0ixs8Hlmz5SyCjZeSCJp_QzlMeFlFPnD7YTWxv-CPeYw056HWQJR9DpBOGIR=s68-c-k-c0x00ffffff-no-rj',
                'email' => 'Doe@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$A09YOngY5TF6sFIlLKpXLeG5KD3xfEgunROTgx8G0gDEvmRN6LEOW',
                'remember_token' => NULL,
                'created_at' => '2022-11-08 08:15:10',
                'updated_at' => '2022-11-08 08:15:10',
            ),
            1 => 
            array (
                'id' => 2,
                'first_name' => 'Marques',
                'last_name' => 'Brownlee',
                'profile_picture' => 'https://yt3.ggpht.com/lkH37D712tiyphnu0Id0D5MwwQ7IRuwgQLVD05iMXlDWO-kDHut3uI4MgIEAQ9StK0qOST7fiA=s68-c-k-c0x00ffffff-no-rj',
                'email' => 'achraf@ksldf.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$Y70dP791Lu9qoVCQurIDSuFBrg7ZiM9ycZLXgpW69CxYe3uPD2eve',
                'remember_token' => NULL,
                'created_at' => '2022-11-08 08:18:13',
                'updated_at' => '2022-11-08 08:18:13',
            ),
            2 => 
            array (
                'id' => 3,
                'first_name' => 'Best Ever Food',
                'last_name' => 'Review Show',
                'profile_picture' => 'https://yt3.ggpht.com/ytc/AMLnZu830cixL9nUBmBIiXXI5zsSA6ikTd_Jm5cMXBFYvQ=s68-c-k-c0x00ffffff-no-rj',
                'email' => 'idsaidgoldman@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$mesAaLML5JLiY5.41r/HlOj49rL8CfmTuaRIF35BsNs4ePtN8iTDW',
                'remember_token' => NULL,
                'created_at' => '2022-11-08 08:20:40',
                'updated_at' => '2022-11-08 08:20:40',
            ),
            3 => 
            array (
                'id' => 4,
                'first_name' => 'Iman',
                'last_name' => 'Gadzhi',
                'profile_picture' => 'https://yt3.ggpht.com/XDA6ig1JeTk6W84g4ipe4LhkWsghnDjq1Zuod27XxRrLkthoLBC3gj_zxQcop1kSBzw3BKIj=s68-c-k-c0x00ffffff-no-rj',
                'email' => 'jdf@sdf.clk',
                'email_verified_at' => NULL,
                'password' => '$2y$10$eVi9C9JJYBGyi1GA4by95.73TMzLStUxX/yGR/5SW5uPsR7LDL/mu',
                'remember_token' => NULL,
                'created_at' => '2022-11-08 08:22:12',
                'updated_at' => '2022-11-08 08:22:12',
            ),
            4 => 
            array (
                'id' => 5,
                'first_name' => 'Yes',
                'last_name' => 'Theory',
                'profile_picture' => 'https://yt3.ggpht.com/vVNRN2owIpF1EKhfENoMhDRwNNXHDjL1o_6oG3K13aMlu3dyl4DZuWkq_oAv8an-B1D5Mzbn_UM=s68-c-k-c0x00ffffff-no-rj',
                'email' => 'jjlksdjf@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$eRaAFDjwgJFZ/4AspLVijOFtyTrJDdtF3INEIKqYaMSOBsEXKojvi',
                'remember_token' => NULL,
                'created_at' => '2022-11-08 08:23:29',
                'updated_at' => '2022-11-08 08:23:29',
            ),
            5 => 
            array (
                'id' => 6,
                'first_name' => 'BeardMeats',
                'last_name' => 'Food',
                'profile_picture' => 'https://yt3.ggpht.com/ytc/AMLnZu_rQvhA0RJFgAODQp36cnBibrpk-N_jEJ451ZCAJA=s68-c-k-c0x00ffffff-no-rj',
                'email' => 'robinson@nick.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$8xRjic0PL9gzYKsHh3kx2uKPrrmLiUk5cqaJbp3..3ONrrMd7/zFW',
                'remember_token' => NULL,
                'created_at' => '2022-11-08 08:25:25',
                'updated_at' => '2022-11-08 08:25:25',
            ),
            6 => 
            array (
                'id' => 7,
                'first_name' => 'PewDie',
                'last_name' => 'Pie',
                'profile_picture' => 'https://yt3.ggpht.com/5oUY3tashyxfqsjO5SGhjT4dus8FkN9CsAHwXWISFrdPYii1FudD4ICtLfuCw6-THJsJbgoY=s68-c-k-c0x00ffffff-no-rj',
                'email' => 'mongo@db.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$8Taw9rn28TyCiCFJQ409deGI2Ffws.ogkejC/U0lJj/jWxNrwO5sa',
                'remember_token' => NULL,
                'created_at' => '2022-11-08 08:27:19',
                'updated_at' => '2022-11-08 08:27:19',
            ),
            7 => 
            array (
                'id' => 8,
                'first_name' => 'Dude',
                'last_name' => 'Perfect',
                'profile_picture' => 'https://yt3.ggpht.com/ytc/AMLnZu90IH7DzDRUzWcW434S2eA__PfKGH3RQwf2--Dvsg=s68-c-k-c0x00ffffff-no-rj',
                'email' => 'dude@perfect.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$LpsPReOZOa.UfRYJxD9SyekbCSr0p0kCeyTceDp060hvDDxraL3A.',
                'remember_token' => NULL,
                'created_at' => '2022-11-08 08:29:32',
                'updated_at' => '2022-11-08 08:29:32',
            ),
        ));
        
        
    }
}