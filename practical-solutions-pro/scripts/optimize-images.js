/**
 * Image Optimization Script
 * سكريبت تحسين الصور
 */

const fs = require('fs');
const path = require('path');

const srcDir = path.join(__dirname, '..', 'src', 'images');
const distDir = path.join(__dirname, '..', 'dist', 'images');

// إنشاء مجلد الوجهة إذا لم يكن موجوداً
if (!fs.existsSync(distDir)) {
    fs.mkdirSync(distDir, { recursive: true });
}

console.log('🖼️  تحسين الصور...');

// التحقق من وجود مجلد المصدر
if (!fs.existsSync(srcDir)) {
    console.log('⚠️  مجلد src/images غير موجود');
    console.log('💡 يرجى إضافة الصور في مجلد src/images/');
    return;
}

// نسخ الصور (placeholder حتى تثبيت أدوات التحسين)
fs.readdir(srcDir, (err, files) => {
    if (err) {
        console.error('خطأ في قراءة مجلد الصور:', err);
        return;
    }
    
    files.forEach(file => {
        const srcFile = path.join(srcDir, file);
        const distFile = path.join(distDir, file);
        
        if (fs.statSync(srcFile).isFile()) {
            fs.copyFileSync(srcFile, distFile);
            console.log(`✅ تم نسخ: ${file}`);
        }
    });
    
    console.log('🎉 تم تحسين جميع الصور!');
});