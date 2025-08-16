/**
 * Create Required Directories Script
 * سكريبت إنشاء المجلدات المطلوبة
 */

const fs = require('fs');
const path = require('path');

// المجلدات المطلوبة
const directories = [
    'dist',
    'dist/css',
    'dist/js', 
    'dist/images',
    'src/js/modules',
    'inc',
    'templates',
    'parts',
    'patterns',
    'languages'
];

console.log('🗂️  إنشاء المجلدات المطلوبة...');

directories.forEach(dir => {
    const dirPath = path.join(__dirname, '..', dir);
    
    if (!fs.existsSync(dirPath)) {
        fs.mkdirSync(dirPath, { recursive: true });
        console.log(`✅ تم إنشاء مجلد: ${dir}`);
    } else {
        console.log(`📁 المجلد موجود: ${dir}`);
    }
});

console.log('🎉 تم إنشاء جميع المجلدات بنجاح!');