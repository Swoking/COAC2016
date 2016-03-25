#include "coac.h"
#include <QBuffer>
#include <QDateTime>
#include <QSqlQuery>
#include <QModelIndex>
#include <QSqlError>
#include <QTimer>
#include <QNetworkReply>
#include <QWebFrame>
#include <QWebElement>
#include <QPrinter>

COAC::COAC(Database *database, QWidget *parent) :
    QMainWindow(parent),
    mode(Ajout),
    db(database)
{
    setupUi(this);

    camera = new Camera();

    connect(pbuEnvoyer, SIGNAL(clicked(bool)), this, SLOT(Envoyer(bool)));
    connect(pbuTakeImage, SIGNAL(clicked(bool)), this, SLOT(imageCapture(bool)));
    connect(actionListEleve, SIGNAL(triggered(bool)), this, SLOT(onPushActionListEleve(bool)));
    connect(actionListClasse, SIGNAL(triggered(bool)), this, SLOT(onPushActionListClasse(bool)));
    connect(actionListSalle, SIGNAL(triggered(bool)), this, SLOT(onPushActionListSalle(bool)));
    connect(actionListCarte, SIGNAL(triggered(bool)), this, SLOT(onPushActionListCarte(bool)));
    connect(actionListLog, SIGNAL(triggered(bool)), this, SLOT(onPushActionListLog(bool)));
    connect(actionAjouterCarte, SIGNAL(triggered(bool)), this, SLOT(onPushActionAjouterCarte(bool)));
    connect(actionAjouterClasse, SIGNAL(triggered(bool)), this, SLOT(onPushActionAjouterClasse(bool)));
    connect(actionAjouterSalle, SIGNAL(triggered(bool)), this, SLOT(onPushActionAjouterSalle(bool)));
    connect(actionAjouterLycee, SIGNAL(triggered(bool)), this, SLOT(onPushActionAjouterLycee(bool)));
    connect(pbuRefreshCarte, SIGNAL(clicked()), this, SLOT(mydebug()));
    init();

    //connect(eleveList->, SIGNAL())

    stackedWidget->setCurrentIndex(0);
    showCamera();
}

void COAC::mydebug(){
    qDebug() << webView->page()->currentFrame()->toHtml();

    QPrinter printer(QPrinter::HighResolution);
    printer.setOutputFormat(QPrinter::PdfFormat);
    printer.setPageMargins(0,0,0,0,QPrinter::Millimeter);
    qreal w = 50; qreal h = 29.2;
    printer.setPaperSize(QSizeF(w, h), QPrinter::Millimeter);
    printer.setOutputFileName("html.pdf");

    webView->print(&printer);
}

void COAC::onPushActionAjouterCarte(bool i){
    Q_UNUSED(i)
    carteAdd = new AddCarte(this, db);
    carteAdd->show();
}

void COAC::onPushActionAjouterClasse(bool i){
    Q_UNUSED(i)
    classeAdd = new AddClasse(this, db);
    classeAdd->show();
}

void COAC::onPushActionAjouterSalle(bool i){
    Q_UNUSED(i)
    salleAdd = new AddSalle(this, db);
    salleAdd->show();
}

void COAC::onPushActionAjouterLycee(bool i){
    Q_UNUSED(i)
    lyceeAdd = new AddLycee(this, db);
    lyceeAdd->show();
}

void COAC::onPushActionListEleve(bool i){
    Q_UNUSED(i)
    eleveList = new ListEleve(this, db);
    eleveList->show();
}

void COAC::onPushActionListClasse(bool i){
    Q_UNUSED(i)
    classeList = new ListClasse(this, db);
    classeList->show();
}

void COAC::onPushActionListSalle(bool i){
    Q_UNUSED(i)
    salleList = new ListSalle(this, db);
    salleList->show();
}

void COAC::onPushActionListCarte(bool i){
    Q_UNUSED(i)
    carteList = new ListCarte(this, db);
    carteList->show();
}

void COAC::onPushActionListLog(bool i){
    Q_UNUSED(i)
    logList = new ListLog(this, db);
    logList->show();
}

void COAC::init(){

    QSqlQuery query;
    query.exec( "SELECT * FROM Promo;" );
    while ( query.next() ) {
        cmbPromos->addItem( QString(query.value(3).toString()), QVariant(query.value(0).toInt()) );
    }

    for (int i = 1; i <= 31; i++) {
        if(i < 10){
            cmbJour->addItem( QString::number(i), QVariant("0" + QString::number(i)) );
        } else {
            cmbJour->addItem( QString::number(i), QVariant(QString::number(i)) );
        }
    }

    cmbMoi->addItem( QString("Janvier"),   QVariant("01") );
    cmbMoi->addItem( QString("Février"),   QVariant("02") );
    cmbMoi->addItem( QString("Mars"),      QVariant("03") );
    cmbMoi->addItem( QString("Avril"),     QVariant("04") );
    cmbMoi->addItem( QString("Mai"),       QVariant("05") );
    cmbMoi->addItem( QString("Juin"),      QVariant("06") );
    cmbMoi->addItem( QString("Juillet"),   QVariant("07") );
    cmbMoi->addItem( QString("Aoùt"),      QVariant("08") );
    cmbMoi->addItem( QString("Septembre"), QVariant("09") );
    cmbMoi->addItem( QString("Octobre"),   QVariant("10") );
    cmbMoi->addItem( QString("Novembre"),  QVariant("11") );
    cmbMoi->addItem( QString("Décembre"),  QVariant("12") );

    for( int i = QDateTime::currentDateTime().date().year(); i >= 1980; i--) {
        cmbAnnee->addItem( QString::number(i), QVariant(i) );
    }





    webView->setUrl(QString("http://192.168.1.200/COAC2016/public/html.carte.php?id=24"));
    webView->show();
}

void COAC::setEleveInfo(){

    nom = ledtNom->text();
    prenom = ledtPrenom->text();
    idPromo = cmbPromos->itemData( cmbPromos->currentIndex() ).toInt();
    adresse = ledtAddr->text();
    ville = ledtVille->text();
    cp = ledtCP->text();
    mail = ledtMail->text();
    if(rdbHomme->isChecked()) { sex = "Masculin"; }
    else {                      sex =  "Feminin";  }
    date = cmbAnnee->itemData( cmbAnnee->currentIndex() ).toString() + "-" +cmbMoi->itemData( cmbMoi->currentIndex() ).toString() + "-" + cmbJour->itemData( cmbJour->currentIndex() ).toString();

}

void COAC::Envoyer(bool c) {

    Q_UNUSED(c);

    if (db->getDB().isOpen()) {
        if(mode == Ajout){
            setEleveInfo();

            QByteArray imgByteArray;
            QBuffer bufferImg(&imgByteArray);
            bufferImg.open(QIODevice::WriteOnly);
            camera->image.save(&bufferImg, "jpg");

            QSqlQuery query;
            query.prepare("INSERT INTO `COAC2016`.`Etudiant` (`id`, `Nom`, `Prenom`, `id_Promo`, `id_Lycee`, `Adresse`, `Ville`, `CP`, `Email`, `Sexe`, `Date_Naissance`, `Image`) "
                          "VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);");
            query.addBindValue(nom);
            query.addBindValue(prenom);
            query.addBindValue(idPromo);
            query.addBindValue(1);
            query.addBindValue(adresse);
            query.addBindValue(ville);
            query.addBindValue(cp);
            query.addBindValue(mail);
            query.addBindValue(sex);
            query.addBindValue(date);
            query.addBindValue(imgByteArray);
            query.exec();
            qDebug() << "COAC::Envoyer() > " << "Sql error:" << query.lastError().text() << ", Sql error code:" << query.lastError().number();
            qDebug() << "COAC::Envoyer() > " << "Sql query:" << query.lastQuery();
        } else {
            setEleveInfo();

            QSqlQuery query;
            query.prepare("UPDATE Etudiant SET  Nom = ? ,"
                                               "Prenom = ? ,"
                                               "id_Promo = ? ,"
                                               "id_Lycee = ? ,"
                                               "Adresse = ? ,"
                                               "Ville = ? ,"
                                               "CP = ? ,"
                                               "Email = ? ,"
                                               "Sexe = ? ,"
                                               "Date_Naissance = ? ,"
                                               "Image = ?"
                          "WHERE id = ? ");
            query.addBindValue(nom);
            query.addBindValue(prenom);
            query.addBindValue(idPromo);
            query.addBindValue(1);
            query.addBindValue(adresse);
            query.addBindValue(ville);
            query.addBindValue(cp);
            query.addBindValue(mail);
            query.addBindValue(sex);
            query.addBindValue(date);
            query.addBindValue(camera->image);
            query.addBindValue(id);
            query.exec();
            qDebug() << "COAC::Envoyer() > " << "Sql error:" << query.lastError().text() << ", Sql error code:" << query.lastError().number();
            qDebug() << "COAC::Envoyer() > " << "Sql query:" << query.lastQuery();
        }
    }

}

void COAC::showCamera(){
    qDebug() << "COAC::showCamera() > set viewfinder";
    camera->my_camera->setViewfinder(viewfinder);

    qDebug() << "COAC::showCamera() > show viewfinder";
    viewfinder->show();
    camera->my_camera->start();

    showOverlay();
}

void COAC::imageCapture(bool)
{
    camera->setViewfinder(viewfinder);
    camera->imageCapture->capture();

    // tant que le signal n'est pas émit et que le process n'est pas fini
    camera->setFinishProcessCapture(false);

    qDebug() << "COAC::imageCapture() > Attente de la prise de photo";
    while (!camera->isFinishProcessCapture()) {
        QCoreApplication::processEvents();
    }

    qDebug() << "H : " << camera->image.height() << " W : " << camera->image.width();

    // affichage de l'image
    lastImagePreviewLabel->setPixmap(QPixmap::fromImage(camera->image));

    displayCapturedImage();
    QTimer::singleShot( 4000, this, SLOT( displayViewfinder() ) );
}

void COAC::displayViewfinder()
{
    stackedWidget->setCurrentIndex(0);
}

void COAC::displayCapturedImage()
{
    stackedWidget->setCurrentIndex(1);
}

void COAC::showOverlay(){
    //QPointer<Overlay> m_overlay;
    Overlay *overlayGauche = new Overlay(viewfinder->parentWidget());
    Overlay *overlayDroit = new Overlay(viewfinder->parentWidget());

    int overlayBorderLargeur = (viewfinder->geometry().size().width() - (viewfinder->geometry().size().height()/28*23))/2 ;


    QRect rectGauche = viewfinder->geometry();
    rectGauche.setWidth( overlayBorderLargeur - 20 );
    rectGauche.setHeight( viewfinder->geometry().size().height() - 280 );
    overlayGauche->setGeometry(rectGauche);
    overlayGauche->show();

    QRect rectDroit = viewfinder->geometry();
    //rectDroit.setX( overlayBorderLargeur + (rectDroit.size().height()/45*35));
    rectDroit.setX( overlayBorderLargeur + 115);
    rectDroit.setWidth( overlayBorderLargeur - 20);
    rectDroit.setHeight( viewfinder->geometry().size().height() - 280 );

    overlayDroit->setGeometry(rectDroit);

    overlayDroit->show();
}

void COAC::onDoubleClickListEleve(QModelIndex index){

    qDebug() << "COAC::onDoubleClickListEleve() > " << index.data(Qt::UserRole + 1).toInt();
    mode = Edition;

    if(db->getDB().isOpen()){
        QSqlQuery query;
        query.prepare("SELECT * FROM Etudiant WHERE id = ?");
        query.addBindValue(index.data(Qt::UserRole + 1).toInt());
        query.exec();
        query.next();

        id = query.value(0).toInt();
        ledtNom->setText( query.value(1).toString() );
        ledtPrenom->setText( query.value(2).toString() );
        int tempIdProm1o = cmbPromos->findData( query.value(3).toInt() );
        cmbPromos->setCurrentIndex( tempIdProm1o );
        ledtAddr->setText( query.value(5).toString() );
        ledtVille->setText( query.value(6).toString() );
        ledtCP->setText( query.value(7).toString() );
        ledtMail->setText( query.value(8).toString() );
        if(query.value(9).toString() == "Masculin") {   rdbHomme->setChecked(true); }
        else {                                          rdbFemme->setChecked(true); }
        QStringList piecesDate = query.value(10).toString().split("-");
        int tempDateYear    = cmbAnnee->findData( piecesDate.value( query.value(10).toString().split("-").length() - 3 ) );
        int tempDateMonth   = cmbMoi->findData( piecesDate.value( query.value(10).toString().split("-").length() - 2 ) );
        int tempDateDay     = cmbJour->findData( piecesDate.value( query.value(10).toString().split("-").length() -1 ) );
        qDebug() << tempDateDay;
        cmbAnnee->setCurrentIndex(tempDateYear);
        cmbMoi->setCurrentIndex(tempDateMonth);
        cmbJour->setCurrentIndex(tempDateDay);
    }

}

void COAC::closeEvent(QCloseEvent *) {

}
