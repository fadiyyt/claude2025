/**
 * Icon Generator Script for Practical Solutions Pro
 * مولد الأيقونات لقالب الحلول العملية الاحترافي
 */

const fs = require('fs');
const path = require('path');

// إعدادات الأيقونات المطلوبة لـ PWA
const iconSizes = [72, 96, 128, 144, 152, 192, 384, 512];
const distDir = path.join(__dirname, '..', 'dist', 'images');
const srcIcon = path.resolve(__dirname, '..', 'src', 'images', 'logo.png');

// إنشاء مجلد الوجهة إذا لم يكن موجوداً
if (!fs.existsSync(distDir)) {
    fs.mkdirSync(distDir, { recursive: true });
}

// التحقق من وجود الأيقونة المصدر
if (!fs.existsSync(srcIcon)) {
    console.log('⚠️  لم يتم العثور على logo.png في src/images/');
    console.log('📝 سيتم إنشاء أيقونات افتراضية...');
    
    // إنشاء ملفات أيقونات فارغة للاختبار
    iconSizes.forEach(size => {
        const iconPath = path.join(distDir, `icon-${size}.png`);
        const placeholderContent = `<!-- Placeholder icon ${size}x${size} -->`;
        fs.writeFileSync(iconPath.replace('.png', '.txt'), placeholderContent);
    });
    
    console.log('✅ تم إنشاء ملفات أيقونات placeholder');
    console.log('💡 يرجى إضافة logo.png في مجلد src/images/ لإنشاء أيقونات حقيقية');
    return;
}

// إذا كان sharp متاحاً، استخدمه لتغيير حجم الصور
try {
    const sharp = require('sharp');
    
    async function generateIcons() {
        console.log('🎨 جاري إنشاء الأيقونات...');
        
        for (const size of iconSizes) {
            const outputPath = path.join(distDir, `icon-${size}.png`);
            
            try {
                await sharp(srcIcon)
                    .resize(size, size)
                    .png({ quality: 90 })
                    .toFile(outputPath);
                
                console.log(`✅ تم إنشاء icon-${size}.png`);
            } catch (err) {
                console.error(`❌ خطأ في إنشاء icon-${size}.png:`, err.message);
            }
        }
        
        // إنشاء favicon.ico
        try {
            await sharp(srcIcon)
                .resize(32, 32)
                .png()
                .toFile(path.join(distDir, 'favicon-32x32.png'));
            
            console.log('✅ تم إنشاء favicon-32x32.png');
        } catch (err) {
            console.error('❌ خطأ في إنشاء favicon:', err.message);
        }
        
        console.log('🎉 تم إنشاء جميع الأيقونات بنجاح!');
    }
    
    generateIcons().catch(console.error);
    
} catch (err) {
    console.log('⚠️  sharp غير مثبت، سيتم إنشاء أيقونات placeholder');
    console.log('💡 لتثبيت sharp: npm install --save-dev sharp');
    
    // إنشاء ملفات placeholder
    iconSizes.forEach(size => {
        const iconPath = path.join(distDir, `icon-${size}.png`);
        const placeholderPath = iconPath.replace('.png', '.txt');
        fs.writeFileSync(placeholderPath, `Placeholder icon ${size}x${size}`);
    });
    
    console.log('✅ تم إنشاء ملفات placeholder');
}