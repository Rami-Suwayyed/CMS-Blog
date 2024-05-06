<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Permission::firstOrCreate(['slug' => 'admin-control'], ['name' => ["en" => "Admin Control", "ar" => "التحكم بالمدير"]]);
        Permission::firstOrCreate(['slug' => 'role-read'], ['name' => ["en" => "Role Read", "ar" => "عرض الأدوار"]]);
        Permission::firstOrCreate(['slug' => 'role-create'], ['name' => ["en" => "Role Create", "ar" => "إنشاء دور"]]);
        Permission::firstOrCreate(['slug' => 'role-edit'], ['name' => ["en" => "Role Edit", "ar" => "تعديل دور"]]);
        Permission::firstOrCreate(['slug' => 'role-delete'], ['name' => ["en" => "Role Delete", "ar" => "حذف دور"]]);
        Permission::firstOrCreate(['slug' => 'permission-read'], ['name' => ["en" => "Permission Read", "ar" => "عرض الصلاحيات"]]);
        Permission::firstOrCreate(['slug' => 'permission-create'], ['name' => ["en" => "Permission Create", "ar" => "إنشاء صلاحية"]]);
        Permission::firstOrCreate(['slug' => 'permission-edit'], ['name' => ["en" => "Permission Edit", "ar" => "تعديل صلاحية"]]);
        Permission::firstOrCreate(['slug' => 'permission-delete'], ['name' => ["en" => "Permission Delete", "ar" => "حذف صلاحية"]]);
        Permission::firstOrCreate(['slug' => 'user-read'], ['name' => ["en" => "User Read", "ar" => "عرض المستخدمين"]]);
        Permission::firstOrCreate(['slug' => 'user-create'], ['name' => ["en" => "User Create", "ar" => "إنشاء مستخدم"]]);
        Permission::firstOrCreate(['slug' => 'user-edit'], ['name' => ["en" => "User Edit", "ar" => "تعديل مستخدم"]]);
        Permission::firstOrCreate(['slug' => 'user-delete'], ['name' => ["en" => "User Delete", "ar" => "حذف مستخدم"]]);
        Permission::firstOrCreate(['slug' => 'category-read'], ['name' => ["en" => "Category Read", "ar" => "عرض الفئات"]]);
        Permission::firstOrCreate(['slug' => 'category-create'], ['name' => ["en" => "Category Create", "ar" => "إنشاء فئة"]]);
        Permission::firstOrCreate(['slug' => 'category-edit'], ['name' => ["en" => "Category Edit", "ar" => "تعديل فئة"]]);
        Permission::firstOrCreate(['slug' => 'category-delete'], ['name' => ["en" => "Category Delete", "ar" => "حذف فئة"]]);
        Permission::firstOrCreate(['slug' => 'product-read'], ['name' => ["en" => "Product Read", "ar" => "عرض المنتجات"]]);
        Permission::firstOrCreate(['slug' => 'product-create'], ['name' => ["en" => "Product Create", "ar" => "إنشاء منتج"]]);
        Permission::firstOrCreate(['slug' => 'product-edit'], ['name' => ["en" => "Product Edit", "ar" => "تعديل منتج"]]);
        Permission::firstOrCreate(['slug' => 'product-delete'], ['name' => ["en" => "Product Delete", "ar" => "حذف منتج"]]);
        Permission::firstOrCreate(['slug' => 'slider-read'], ['name' =>   ["en" => "Slider Read", "ar" => "عرض السلايدر"]]);
        Permission::firstOrCreate(['slug' => 'slider-create'], ['name' => ["en" => "Slider Create", "ar" => "إنشاء سلايدر"]]);
        Permission::firstOrCreate(['slug' => 'slider-update'], ['name' => ["en" => "Slider Update", "ar" => "تعديل سلايدر"]]);
        Permission::firstOrCreate(['slug' => 'slider-delete'], ['name' => ["en" => "Slider Delete", "ar" => "حذف سلايدر"]]);
        Permission::firstOrCreate(['slug' => 'about-read'], ['name' => ["en" => "About Read", "ar" => "عرض من نحن"]]);
        Permission::firstOrCreate(['slug' => 'about-create'], ['name' => ["en" => "About Create", "ar" => "إنشاء من نحن"]]);
        Permission::firstOrCreate(['slug' => 'about-edit'], ['name' => ["en" => "About Edit", "ar" => "تعديل من نحن"]]);
        Permission::firstOrCreate(['slug' => 'about-delete'], ['name' => ["en" => "About Delete", "ar" => "حذف من نحن"]]);
        Permission::firstOrCreate(['slug' => 'social_media-read'], ['name' => ["en" => "Social Media Read", "ar" => "عرض وسائل التواصل"]]);
        Permission::firstOrCreate(['slug' => 'social_media-create'], ['name' => ["en" => "Social Media Create", "ar" => "إنشاء وسائل التواصل"]]);
        Permission::firstOrCreate(['slug' => 'social_media-edit'], ['name' => ["en" => "Social Media Edit", "ar" => "تعديل وسائل التواصل"]]);
        Permission::firstOrCreate(['slug' => 'social_media-delete'], ['name' => ["en" => "Social Media Delete", "ar" => "حذف وسائل التواصل"]]);
        Permission::firstOrCreate(['slug' => 'clients-read'], ['name' => ["en" => "Clients Read", "ar" => "عرض العملاء"]]);
        Permission::firstOrCreate(['slug' => 'clients-create'], ['name' => ["en" => "Clients Create", "ar" => "إنشاء عميل"]]);
        Permission::firstOrCreate(['slug' => 'clients-edit'], ['name' => ["en" => "Clients Edit", "ar" => "تعديل عميل"]]);
        Permission::firstOrCreate(['slug' => 'clients-delete'], ['name' => ["en" => "Clients Delete", "ar" => "حذف عميل"]]);
        Permission::firstOrCreate(['slug' => 'contact-read'], ['name' => ["en" => "Contact Read", "ar" => "عرض الاتصال"]]);
        Permission::firstOrCreate(['slug' => 'contact-create'], ['name' => ["en" => "Contact Create", "ar" => "إنشاء اتصال"]]);
        Permission::firstOrCreate(['slug' => 'contact-edit'], ['name' => ["en" => "Contact Edit", "ar" => "تعديل اتصال"]]);
        Permission::firstOrCreate(['slug' => 'contact-delete'], ['name' => ["en" => "Contact Delete", "ar" => "حذف اتصال"]]);
        Permission::firstOrCreate(['slug' => 'setting-read'], ['name' => ["en" => "Setting Read", "ar" => "عرض الإعدادات"]]);
        Permission::firstOrCreate(['slug' => 'setting-create'], ['name' => ["en" => "Setting Create", "ar" => "إنشاء إعدادات"]]);
        Permission::firstOrCreate(['slug' => 'setting-edit'], ['name' => ["en" => "Setting Edit", "ar" => "تعديل إعدادات"]]);
        Permission::firstOrCreate(['slug' => 'setting-delete'], ['name' => ["en" => "Setting Delete", "ar" => "حذف إعدادات"]]);
        Permission::firstOrCreate(['slug' => 'language-read'], ['name' => ["en" => "Language Read", "ar" => "عرض اللغات"]]);
        Permission::firstOrCreate(['slug' => 'language-create'], ['name' => ["en" => "Language Create", "ar" => "إنشاء لغة"]]);
        Permission::firstOrCreate(['slug' => 'language-edit'], ['name' => ["en" => "Language Edit", "ar" => "تعديل لغة"]]);
        Permission::firstOrCreate(['slug' => 'language-delete'], ['name' => ["en" => "Language Delete", "ar" => "حذف لغة"]]);
        Permission::firstOrCreate(['slug' => 'menu-read'], ['name' => ["en" => "Menu Read", "ar" => "عرض القائمة"]]);
        Permission::firstOrCreate(['slug' => 'menu-create'], ['name' => ["en" => "Menu Create", "ar" => "إنشاء قائمة"]]);
        Permission::firstOrCreate(['slug' => 'menu-edit'], ['name' => ["en" => "Menu Edit", "ar" => "تعديل قائمة"]]);
        Permission::firstOrCreate(['slug' => 'menu-delete'], ['name' => ["en" => "Menu Delete", "ar" => "حذف قائمة"]]);
        Permission::firstOrCreate(['slug' => 'branches-read'], ['name' => ["en" => "Branches Read", "ar" => "عرض الفروع"]]);
        Permission::firstOrCreate(['slug' => 'branches-create'], ['name' => ["en" => "Branches Create", "ar" => "إنشاء فرع"]]);
        Permission::firstOrCreate(['slug' => 'branches-edit'], ['name' => ["en" => "Branches Edit", "ar" => "تعديل فرع"]]);
        Permission::firstOrCreate(['slug' => 'branches-delete'], ['name' => ["en" => "Branches Delete", "ar" => "حذف فرع"]]);
        Permission::firstOrCreate(['slug' => 'customer-read'], ['name' => ["en" => "Customer Read", "ar" => "عرض العملاء"]]);
        Permission::firstOrCreate(['slug' => 'customer-create'], ['name' => ["en" => "Customer Create", "ar" => "إنشاء عميل"]]);
        Permission::firstOrCreate(['slug' => 'customer-edit'], ['name' => ["en" => "Customer Edit", "ar" => "تعديل عميل"]]);
        Permission::firstOrCreate(['slug' => 'customer-delete'], ['name' => ["en" => "Customer Delete", "ar" => "حذف عميل"]]);
        Permission::firstOrCreate(['slug' => 'order-read'], ['name' => ["en" => "Order Read", "ar" => "عرض الطلبات"]]);

    }
}
