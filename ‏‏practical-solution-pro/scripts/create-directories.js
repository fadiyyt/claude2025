/**
 * Create necessary directories for build process
 * إنشاء المجلدات المطلوبة لعملية البناء
 */

const fs = require('fs');
const path = require('path');

const directories = [
    'dist',
    'dist/css',
    'dist/js',
    'dist/images',
    'src',
    'src/scss',
    'src/js',
    'src/js/modules',
    'src/images'
];

directories.forEach(dir => {
    const dirPath = path.join(__dirname, '..', dir);
    if (!fs.existsSync(dirPath)) {
        fs.mkdirSync(dirPath, { recursive: true });
        console.log(`✅ Created directory: ${dir}`);
    } else {
        console.log(`📁 Directory already exists: ${dir}`);
    }
});

console.log('🎉 All directories are ready!');