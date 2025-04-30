
<footer style="direction: rtl; background-color: #005364; color: white; padding: 40px 20px; font-family: 'Cairo', sans-serif; margin-top: 80px;">
    <div class="container2">
      <div class="row text-center text-md-start align-items-start">
        
        <!-- "معاً" والوصف -->
        <div class="col-md-4 mb-4 order-1 order-md-1 text-center text-md-start">
            <h4 class="fw-bold mb-3" style="font-size: 25px; margin-left: 200px; text-align: right;">معاً</h4>
            <p style="color: #f1f5f8; font-size: 16px; line-height: 1.6; text-align: right;">
              أصبح من السهل جداً الانضمام إلى مجموعة من المتطوعين المسؤولين، وأن تطلع على كل ما هو جديد من خلال منصة معاً
            </p>
          </div>
      
        <!-- روابط سريعة -->
        <div class="col-md-4 mb-4 order-2 order-md-2 d-flex flex-column align-items-center">
          <h5 class="fw-bold mb-3" style="font-size: 25px; margin-left: 95px;">روابط سريعة</h5>
          <ul class="list-unstyled text-center" style="margin-left: 120px;font-size: 16px;">
              <li class="mb-2">
                  <a href="{{ route('index') }}" class="text-white text-decoration-none d-block">الصفحة الرئيسية</a>
                  
              </li>
              <li class="mb-2">
                  <a href="{{ route('تعرف') }}" class="text-white text-decoration-none d-block">تعرف علينا</a>
                 
              </li>
              <li class="mb-2">
                  <a href="{{ route('نساهم') }}" class="text-white text-decoration-none d-block">لماذا نساهم؟</a>
                
              </li>
              <li class="mb-2">
                  <a href="{{ route('عرض') }}" class="text-white text-decoration-none d-block">شارك معنا</a>
                 
              </li>
              <li class="mb-2">
                  <a href="{{ route('بنك') }}" class="text-white text-decoration-none d-block">بنك الأفكار</a>
                 
              </li>
          </ul>
      </div>
      
      
        <div class="col-md-4 mb-4 order-3 order-md-3">
          <h6 class="fw-bold mb-3" style="font-size: 23px; margin-left: 95px;text-align: right;">اشترك في نشرتنا البريدية</h6>
          <form action="{{ route('newsletter.subscribe') }}" method="POST" class="d-flex flex-column flex-sm-row gap-1 mt-3">
            @csrf
            <input type="email" name="email" class="form-control" placeholder="ادخل بريدك الإلكتروني" style="width: 200px;" required>
            <button type="submit" class="btn" style="background-color: #02d3ac; color: white;">اشتركي</button>
          </form>
        </div>
        
      </div>
      
      <hr style="border-top: 1px solid  #02d3ac;">
      
      <!-- الحقوق وأيقونات التواصل -->
      <div class="d-flex justify-content-between align-items-center flex-wrap mt-3 text-center text-md-start">
        <p class="mb-0" style="color: #f1f5f8;">جميع الحقوق محفوظة © 2025 - منصة معاً</p>
        <div style="border: 1px solid#02d3ac; border-radius: 8px; padding: 10px; display: flex; justify-content: center; gap: 15px;">
            <a href="https://www.facebook.com/ma3an" class="text-white"><i class="fab fa-facebook-f"></i></a>
            <a href="https://www.instagram.com/ma3an" class="text-white"><i class="fab fa-instagram"></i></a>
            <a href="https://twitter.com/ma3an" class="text-white"><i class="fab fa-twitter"></i></a>
             <a href="mailto:info@ma3an.org" class="text-white"><i class="fas fa-envelope"></i></a>
          </div>
          
      </div>
    </div>
  </footer>
 <!-- Custom JavaScript -->
 <script src="{{ asset('assets/js/counter.js') }}"></script>
  <script src="{{ asset('assets/js/aboutus.js') }}"></script> 
  <script src="{{ asset('assets/js/joinUs.js') }}"></script>
  <script src="{{ asset('assets/js/showChance.js') }}"></script>
</body>
</html>