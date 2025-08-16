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

// التحقق من وجود مجلد المصدر
if (!fs.existsSync(srcDir)) {
    console.log('⚠️  مجلد src/images غير موجود، سيتم إنشاؤه...');
    fs.mkdirSync(srcDir, { recursive: true });
    
    // إنشاء ملف README
    const readmeContent = `# مجلد الصور المصدر

ضع هنا الصور التي تريد تحسينها:
- logo.png (للأيقونات)
- صور أخرى للموقع

سيتم تحسينها تلقائياً ونسخها إلى dist/images/
`;
    
    fs.writeFileSync(path.join(srcDir, 'README.md'), readmeContent);
    console.log('📝 تم إنشاء مجلد src/images مع ملف README');
    return;
}

// قراءة الملفات
const files = fs.readdirSync(srcDir);
const imageFiles = files.filter(file => 
    /\.(jpg|jpeg|png|gif|svg|webp)$/i.test(file)
);

if (imageFiles.length === 0) {
    console.log('📷 لا توجد صور للتحسين في src/images/');
    return;
}

// محاولة استخدام sharp لتحسين الصور
try {
    const sharp = require('sharp');
    
    async function optimizeImages() {
        console.log('🎨 جاري تحسين الصور...');
        
        for (const file of imageFiles) {
            const srcPath = path.join(srcDir, file);
            const distPath = path.join(distDir, file);
            const ext = path.extname(file).toLowerCase();
            
            try {
                if (ext === '.svg') {
                    // نسخ ملفات SVG مباشرة
                    fs.copyFileSync(srcPath, distPath);
                    console.log(`✅ نسخ ${file}`);
                } else {
                    // تحسين الصور الأخرى
                    await sharp(srcPath)
                        .jpeg({ quality: 85, progressive: true })
                        .png({ quality: 90, compressionLevel: 9 })
                        .webp({ quality: 80 })
                        .toFile(distPath);
                    
                    console.log(`✅ تم تحسين ${file}`);
                }
            } catch (err) {
                console.error(`❌ خطأ في تحسين ${file}:`, err.message);
                // نسخ الملف كما هو في حالة الخطأ
                fs.copyFileSync(srcPath, distPath);
            }
        }
        
        console.log('🎉 تم الانتهاء من تحسين الصور!');
    }
    
    optimizeImages().catch(console.error);
    
} catch (err) {
    console.log('⚠️  sharp غير مثبت، سيتم نسخ الصور بدون تحسين');
    console.log('💡 لتثبيت sharp: npm install --save-dev sharp');
    
    // نسخ الصور بدون تحسين
    imageFiles.forEach(file => {
        const srcPath = path.join(srcDir, file);
        const distPath = path.join(distDir, file);
        fs.copyFileSync(srcPath, distPath);
        console.log(`📋 تم نسخ ${file}`);
    });
    
    console.log('✅ تم نسخ جميع الصور');
}