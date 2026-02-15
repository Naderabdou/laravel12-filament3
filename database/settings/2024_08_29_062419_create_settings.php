<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.site_name_ar', 'موقعي');
        $this->migrator->add('general.site_name_en', 'My website');
        $this->migrator->add('general.logo', 'This is my website');
        $this->migrator->add('general.logo_footer', 'This is my website');
        $this->migrator->add('general.favicon', 'This is my website');

        //default section
        $this->migrator->add('general.title_default_ar', 'بوابتُك الموثوقة لعدالةٍ ناجزة ومستقرة.');
        $this->migrator->add('general.title_default_en', 'Your trusted gateway to swift and stable justice.');
        $this->migrator->add('general.desc_default_ar', ' نمكّن بيئة التحكيم المؤسسي لضمان حفظ الحقوق واستقرار التعاملات. فريقنا مستعد للإجابة على كافة استفساراتكم وتوجيهكم.');
        $this->migrator->add('general.desc_default_en', 'We enable the institutional arbitration environment to ensure the protection of rights and the stability of transactions. Our team is ready to answer all your questions and guide you.');
        // End Default Section

        // Hero Section
        $this->migrator->add('general.hero_image', 'This is my website');
        $this->migrator->add('general.hero_span_ar', 'الجمعية السعودية للمعارض والمؤتمرات');
        $this->migrator->add('general.hero_span_en', 'Saudi Association for Exhibitions and Conferences');
        $this->migrator->add('general.hero_title_one_ar', 'نحو مستقبل مشرق في صناعة المعارض والمؤتمرات');
        $this->migrator->add('general.hero_title_one_en', 'A Bright Future in the Exhibition and Conference Industry');
        $this->migrator->add('general.hero_title_two_ar', 'المعارض والمؤتمرات');
        $this->migrator->add('general.hero_title_two_en', 'Exhibitions and Conferences');
        $this->migrator->add('general.hero_desc_ar', 'الجمعية السعودية للمعارض والمؤتمرات هي المنصة الرسمية لتطوير وتمكين القطاع، نعمل على بناء بيئة تنافسية، دعم الكفاءات الوطنية، وفتح آفاق الاستثمار العالمي بما يتماشى مع رؤية المملكة 2030.');
        $this->migrator->add('general.hero_desc_en', 'Saudi Association for Exhibitions and Conferences is the official platform for developing and enabling the sector, we work to build a competitive environment, support national capabilities, and open global investment opportunities aligned with Saudi Vision 2030.');
        // End Hero Section

        // About Section
        $this->migrator->add('general.title_about_ar', 'اللجنة الدائمة لمراكز التحكيم السعودية');
        $this->migrator->add('general.title_about_en', 'The Standing Committee for Saudi Arbitration Centers');
        $this->migrator->add('general.desc_about_ar', 'هي اللجنة الدائمة لمراكز التحكيم السعودية المشكلة بموجب القرار الصادر عن مجلس الوزراء رقم (68) وتاريخ هي اللجنة الدائمة لمراكز التحكيم السعودية المشكلة بموجب القرار الصادر عن مجلس الوزراء رقم (68) وتاريخ هي اللجنة الدائمة لمراكز التحكيم السعودية المشكلة بموجب القرار الصادر عن مجلس الوزراء رقم (68) وتاريخ هي اللجنة الدائمة لمراكز التحكيم السعودية المشكلة بموجب القرار الصادر عن مجلس الوزراء رقم (68) وتاريخ.');
        $this->migrator->add('general.desc_about_en', 'It is the permanent committee for Saudi arbitration centers established by the Cabinet Resolution No. (68) and date. It is the permanent committee for Saudi arbitration centers established by the Cabinet Resolution No. (68) and date. It is the permanent committee for Saudi arbitration centers established by the Cabinet Resolution No. (68) and date. It is the permanent committee for Saudi arbitration centers established by the Cabinet Resolution No. (68) and date.');
        $this->migrator->add('general.image_about_one', 'المزيد من المعارض والمؤتمرات');
        $this->migrator->add('general.image_about_two', 'المزيد من المعارض والمؤتمرات');
        $this->migrator->add('general.image_about_three', 'المزيد من المعارض والمؤتمرات');

        $this->migrator->add('general.about_years', '2017');
        $this->migrator->add('general.our_value_ar', 'الشفافية | الابتكار | التميز | الشراكة الاستراتيجية.');
        $this->migrator->add('general.our_value_en', 'Transparency | Innovation | Excellence | Strategic Partnership.');
        $this->migrator->add('general.vision_ar', 'اللجنة الدائمة لمراكز التحكيم السعودية هي جهة مسؤولة عن تنظيم وتطوير بيئة التحكيم في المملكة العربية السعودية. تسعى اللجنة إلى إيجاد بيئة تحكيمية عادلة وجاذبة، وتحفيز ونشر ثقافة التحكيم وفق أعلى المعايير، بهدف تخفيف العبء عن القضاء العام.');
        $this->migrator->add('general.vision_en', 'The Permanent Committee for Saudi Arbitration Centers is the body responsible for regulating and developing the arbitration environment in the Kingdom of Saudi Arabia. The Committee strives to create a fair and attractive arbitration environment and to promote and disseminate a culture of arbitration according to the highest standards, with the aim of reducing the burden on the general judiciary.');
        $this->migrator->add('general.goals_ar', 'نحن هنا لنرسم خارطة طريق واضحة لمستقبل التحكيم؛ حيث تجتمع الحوكمة مع الاحترافية لنخلق بيئة قانونية وتجارية تتسم بالعدالة والسرعة. نهدف من خلال استراتيجيتنا إلى تمكين أطراف النزاع وتقديم ضمانات مؤسسية تعزز من موثوقية القرارات التحكيمية واستدامة النمو الاقتصادي.');
        $this->migrator->add('general.goals_en', 'We are here to map a clear path for the future of arbitration; where governance meets professionalism to create a legal and commercial environment that is fair and swift. Our goal through our strategy is to enable the parties to arbitration and provide institutional guarantees that enhance the credibility of commercial arbitration decisions and the sustainable economic growth.');

        $this->migrator->add('general.des_goals_one_ar', 'حوكمة التراخيص وضمان الامتثال');
        $this->migrator->add('general.des_goals_one_en', 'Governance of licenses and compliance assurance');
        $this->migrator->add('general.title_goals_one_ar', 'نتولى مسؤولية الإشراف المباشر والدقيق على كافة عمليات إصدار وتجديد التراخيص الخاصة بمراكز التحكيم التابعة للغرف التجارية السعودية. لا نمنح الترخيص إلا وفق معايير صارمة تضعها اللجنة، لنضمن أن كل مركز مرخص هو واجهة مشرفة تطبق أعلى معايير النزاهة والاحترافية.');
        $this->migrator->add('general.title_goals_one_en', 'We assume the direct and precise responsibility for all issuance and renewal of licenses for arbitration centers affiliated with the Saudi Chambers of Commerce. We do not grant the license unless it is in accordance with strict standards set by the committee, to ensure that each licensed center is a monitoring face that applies the highest standards of transparency and professionalism.');

        $this->migrator->add('general.des_goals_two_ar', 'تأهيل الكفاءات واعتماد المحكمين');
        $this->migrator->add('general.des_goals_two_en', 'Training and accreditation of competencies and arbitrators');
        $this->migrator->add('general.title_goals_two_ar', 'نضع حجر الأساس لمهنة التحكيم عبر صياغة وتحديد المعايير النوعية اللازمة لقيد المحكمين في المراكز المرخصة. هدفنا هو التأكد من أن القائمين على فض النزاعات يمتلكون الخبرة العلمية والعملية الكافية، مما يرفع من جودة الأحكام الصادرة ويحفظ حقوق المتقاضين.');
        $this->migrator->add('general.title_goals_two_en', 'We lay the foundation for the profession of arbitration by formulating and defining the specific standards necessary for the registration of arbitrators in the licensed centers. Our goal is to ensure that those responsible for resolving disputes have the necessary scientific and practical experience, which raises the quality of the decisions issued and protects the rights of the claimants.');

        $this->migrator->add('general.des_goals_three_ar', 'الشفافية المالية وتوحيد المعايير');
        $this->migrator->add('general.des_goals_three_en', 'Financial transparency and standardization');
        $this->migrator->add('general.title_goals_three_ar', 'نعمل على تعزيز الوضوح المالي في القطاع من خلال إعداد أدلة ومعايير استرشادية شاملة لتحديد أتعاب المحكمين وكافة المصاريف التشغيلية في المراكز المرخصة. نؤمن بأن الشفافية في التكاليف هي أولى خطوات بناء الثقة بين المستثمر ومنظومة التحكيم..');
        $this->migrator->add('general.title_goals_three_en', 'We work to enhance financial transparency in the sector by preparing comprehensive guidelines and reference standards to determine the fees of arbitrators and all operating expenses in the licensed centers. We believe that financial transparency is the first steps in building trust between the investor and the arbitration system.');

        $this->migrator->add('general.des_goals_four_ar', 'الريادة المجتمعية وتطوير القطاع');
        $this->migrator->add('general.des_goals_four_en', 'Social leadership and sector development');
        $this->migrator->add('general.title_goals_four_ar', 'نحمل على عاتقنا مهمة النهوض بقطاع التحكيم كاملاً ورفع كفاءة مخرجاته، بالتوازي مع نشر ثقافة التحكيم كخيار استراتيجي وفعّال لتسوية النزاعات. نسعى لأن يصبح التحكيم هو اللغة الأولى والموثوقة في عالم المال والأعمال لضمان سرعة الإنجاز وجودة التنفيذ.');
        $this->migrator->add('general.title_goals_four_en', 'We carry the responsibility of developing the arbitration sector fully and raising the efficiency of its outputs, in parallel with disseminating a culture of arbitration as a strategic and effective option for resolving disputes. We strive to make arbitration the first and most trusted language in the world of finance and business to ensure speed and quality of execution.');

        // End About Section



        //Blog section
        $this->migrator->add('general.blog_title_ar', 'آفاق التحكيم');
        $this->migrator->add('general.blog_title_en', 'Arbitration prospects');
        $this->migrator->add('general.blog_desc_ar', 'مساحتكم المعرفية لاستكشاف أحدث المقالات القانونية والتحليلات العميقة في مجال التحكيم التجاري. نجمع لك رؤى الخبراء ودراسات الحالة لنساهم في تطوير الفكر القانوني ونشر ثقافة التحكيم بأسلوب عصري.');
        $this->migrator->add('general.blog_desc_en', 'Your knowledge hub for exploring the latest legal articles and in-depth analyses in the field of commercial arbitration. We bring together expert insights and case studies to contribute to the development of legal thought and promote a culture of arbitration in a modern way.');
        // End Blog Section

        //FAQ section
        $this->migrator->add('general.faq_title_ar', 'الأسئلة الشائعة');
        $this->migrator->add('general.faq_title_en', 'Frequently Asked Questions');
        $this->migrator->add('general.faq_desc_ar', 'إجابات موجزة ودقيقة على تساؤلاتكم الأكثر شيوعاً. نهتم بتوضيح كافة الجوانب الفنية والقانونية لخدماتنا، لنوفر لك الوضوح اللازم في كل خطوة إجرائية دون عناء البحث');
        $this->migrator->add('general.faq_desc_en', 'Concise and accurate answers to your most frequently asked questions. We take care to explain all the technical and legal aspects of our services, providing you with the necessary clarity at every step of the process without the hassle of searching.');
        // End FAQ Section

        //News section
        $this->migrator->add('general.news_title_ar', 'أخر الأخبار');
        $this->migrator->add('general.news_title_en', 'Latest News');
        $this->migrator->add('general.news_desc_ar', 'ابقَ على اطلاع بكل ما هو جديد؛ نضع بين يديك أحدث المستجدات، الفعاليات، والقرارات الصادرة عن اللجنة أولاً بأول');
        $this->migrator->add('general.news_desc_en', 'Stay updated with the latest news; we bring you the most recent updates, events, and decisions issued by the committee as they happen.');
        // End News Section

        //Arbitration centers section
        $this->migrator->add('general.arbitration_centers_title_ar', 'دليل مراكز التحكيم المعتمدة');
        $this->migrator->add('general.arbitration_centers_title_en', 'Directory of Approved Arbitration Centers');
        $this->migrator->add('general.arbitration_centers_desc_ar', 'نافذتكم الموثوقة للوصول إلى كافة مراكز التحكيم المرخصة رسمياً في المملكة. نضع بين يديكم هذه القائمة المحدثة لضمان اختيار شريك قانوني يلتزم بأعلى معايير الجودة والحوكمة، بما يحفظ حقوقكم ويضمن نزاهة إجراءاتكم.');
        $this->migrator->add('general.arbitration_centers_desc_en', 'Your trusted gateway to all officially licensed arbitration centers in the Kingdom. We provide you with this updated list to ensure you choose a legal partner committed to the highest standards of quality and governance, safeguarding your rights and guaranteeing the integrity of your proceedings.');
        // End Arbitration Centers Section

        //committee form section
        $this->migrator->add('general.committee_form_title_ar', 'النماذج والوثائق الإجرائية');
        $this->migrator->add('general.committee_form_title_en', 'Forms and procedural documents');
        $this->migrator->add('general.committee_form_desc_ar', 'دليلك الموحد لكافة النماذج والوثائق الرسمية؛ صُممت لتسهيل تقديم طلباتك، قيد المحكمين، وتحديث بياناتك بدقة وسرعة وفق المتطلبات النظامية');
        $this->migrator->add('general.committee_form_desc_en', 'Your unified guide to all official forms and documents; designed to facilitate the submission of your applications, registration of arbitrators, and updating of your data accurately and quickly in accordance with regulatory requirements');
        // End Committee Form Section

        //committee decisions and circulars section
        $this->migrator->add('general.committee_decisions_and_circulars_title_ar', 'قرارات وتعاميم اللجنة الدائمة');
        $this->migrator->add('general.committee_decisions_and_circulars_title_en', 'Decisions and circulars of the Standing Committee');
        $this->migrator->add('general.committee_decisions_and_circulars_desc_ar', 'نافذتكم المباشرة على أحدث الموجهات الإدارية والتنظيمية الصادرة عن اللجنة. نهدف من خلال هذا القسم إلى تعزيز الشفافية وإبقاء كافة مراكز التحكيم والممارسين على اطلاع دائم بآخر التحديثات والإجراءات التي تضمن سير العمل وفق الأطر المعتمدة');
        $this->migrator->add('general.committee_decisions_and_circulars_desc_en', 'Your direct window to the latest administrative and regulatory guidelines issued by the committee. Through this section, we aim to enhance transparency and keep all arbitration centers and practitioners informed of the latest updates and procedures that ensure work proceeds according to the approved frameworks');
        // End Committee Decisions and Circulars Section

        //committee systems section
        $this->migrator->add('general.committee_systems_title_ar', 'الدليل التنظيمي والتشريعي');
        $this->migrator->add('general.committee_systems_title_en', 'Regulatory and legal guide');
        $this->migrator->add('general.committee_systems_desc_ar', 'نافذتك المباشرة للوصول إلى كافة الأنظمة التي تضبط ممارسات التحكيم التجاري في المملكة. نضع بين يديك المرجعية القانونية الكاملة لضمان بيئة تحكيمية عادلة ومستقرة.');
        $this->migrator->add('general.committee_systems_desc_en', 'Your direct gateway to all regulations governing commercial arbitration practices in the Kingdom. We provide you with a comprehensive legal framework to ensure a fair and stable arbitration environment.');
        // End Committee Systems Section


        //committee regulations section
        $this->migrator->add('general.committee_regulations_title_ar', 'اللوائح التنفيذية والضوابط');
        $this->migrator->add('general.committee_regulations_title_en', 'Implementing regulations and controls');
        $this->migrator->add('general.committee_regulations_desc_ar', 'هنا نضع بين يديك القواعد التفصيلية والإجراءات التي تترجم الأنظمة إلى واقع عملي. تشمل هذه اللوائح كافة الضوابط التي تحكم عمل مراكز التحكيم، لضمان أعلى مستويات الانضباط المهني والوضوح الإجرائي لجميع المستفيدين.');
        $this->migrator->add('general.committee_regulations_desc_en', 'Here we put in your hands the detailed rules and procedures that translate the systems into a practical reality. These regulations include all the controls that regulate the work of arbitration centers, to ensure the highest levels of professional discipline and procedural transparency for all beneficiaries.');
        // End Committee Regulations Section


        //contact section
        $this->migrator->add('general.contact_title_ar', 'نحن هنا لخدمتكم');
        $this->migrator->add('general.contact_title_en', 'We are here to serve you');
        $this->migrator->add('general.contact_desc_ar', 'سواء كنت تبحث عن توضيح لأحد الأنظمة أو تحتاج إلى دعم فني في إجراءاتك، فريقنا المتخصص جاهز للإجابة على كافة استفساراتكم بدقة واهتمام. تواصل معنا الآن، فصوتكم هو ما يطور خدماتنا.');
        $this->migrator->add('general.contact_desc_en', 'Whether you are seeking clarification on a system or need technical support with your procedures, our expert team is ready to answer all your questions accurately and attentively. Contact us now; your feedback is what drives us to improve our services.');
        // End Contact Section


        //Gallery section
        $this->migrator->add('general.gallery_title_ar', 'يمكنكم الاطلاع على معرض الصور وما يحوي من صور فوتوغرافية متنوعة من قلب الحدث.​');
        $this->migrator->add('general.gallery_title_en', 'You can view the gallery and the various photographs from the heart of the event.');
        // End Gallery Section

        // Contact Section
        $this->migrator->add('general.whatsapp', '');
        $this->migrator->add('general.twitter', '');
        $this->migrator->add('general.linkedin', '');
        $this->migrator->add('general.instagram', '');
        $this->migrator->add('general.phone', '');
        $this->migrator->add('general.email', '');
        $this->migrator->add('general.facebook', '');
        $this->migrator->add('general.address', '');
        $this->migrator->add('general.location', '');
        // End Contact Section

        //footer section
        $this->migrator->add('general.footer_desc_ar', 'اللجنة الدائمة لمراكز التحكيم السعودية هي جهة مسؤولة عن تنظيم وتطوير بيئة التحكيم في المملكة العربية السعودية. تسعى اللجنة إلى إيجاد بيئة تحكيمية عادلة وجاذبة، وتحفيز ونشر ثقافة التحكيم وفق أعلى المعايير، بهدف تخفيف العبء عن القضاء العام.');
        $this->migrator->add('general.footer_desc_en', 'The Permanent Committee for Saudi Arbitration Centers is the body responsible for regulating and developing the arbitration environment in the Kingdom of Saudi Arabia. The Committee strives to create a fair and attractive arbitration environment and to promote and disseminate a culture of arbitration according to the highest standards, with the aim of reducing the burden on the general judiciary.');
        $this->migrator->add('general.footer_copyright_ar', 'جميع الحقوق محفوظة © 2026 اللجنة الدائمة لمراكز التحكيم السعودية');
        $this->migrator->add('general.footer_copyright_en', 'All rights reserved © 2026 The Permanent Committee for Saudi Arbitration Centers');
        $this->migrator->add('general.footer_image', '');
        // End Footer Section






    }
};
