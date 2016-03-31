#include "coac.h"
#include <QDateTime>
#include <QTimer>
#include <QCameraImageCapture>
#include <QStandardItemModel>
#include <QToolButton>

COAC::COAC( QWidget *parent ) :
    QMainWindow(parent),
    mode(Ajout)
{
    setupUi(this);

    camera = new Camera();
    elevelist = new EleveList(this);
    addcarte = new AddCarte(this);
    addclasse = new AddClass(this);
    connect( actionEleve,           SIGNAL(triggered(bool)), this, SLOT(onPushActionEleve(bool)) );
    connect( actionAjouterCarte,    SIGNAL(triggered(bool)), this, SLOT(onPushActionAddCarte(bool)) );
    connect( actionAjouterClasse,   SIGNAL(triggered(bool)), this, SLOT(onPushActionAddClasse(bool)) );
    connect( camera->imageCapture,  SIGNAL(imageCaptured(int,QImage)),    camera,   SLOT(processCapturedImage(int,QImage)));
    //connect(camera->imageCapture, SIGNAL(readyForCaptureChanged(bool)), camera,   SLOT(readyForCapture(bool)));
    //connect(camera->imageCapture, SIGNAL(imageCaptured(int,QImage)),    camera,   SLOT(processCapturedImage(int,QImage)));
    //connect(camera->imageCapture, SIGNAL(imageSaved(int,QString)),      camera,   SLOT(imageSaved(int,QString)));
    //connect(camera->imageCapture, SIGNAL(error(int,QCameraImageCapture::Error,QString)), this, SLOT(displayCaptureError(int,QCameraImageCapture::Error,QString)));

    connect(pbuEnvoyer, SIGNAL(clicked(bool)), this, SLOT(Envoyer(bool)));
    connect(pbuTakeImage, SIGNAL(clicked(bool)), this, SLOT(imageCapture(bool)));
    stackedWidget->setCurrentIndex(0);
    showCamera();
}

void COAC::onPushActionEleve(bool i){
    Q_UNUSED(i)
    elevelist = new EleveList(this);
    elevelist->show();
}
void COAC::onPushActionAddCarte(bool i) {
    Q_UNUSED(i)
    addcarte = new AddCarte(this);
    addcarte->show();
}

void COAC::onPushActionAddClasse(bool i) {
    Q_UNUSED(i)
    addclasse = new AddClass(this);
    addclasse->show();
}

void COAC::printPromos() {
    Database db;
    QSqlQuery query;
    query.exec( "SELECT * FROM Promo;" );
    while ( query.next() ) {
        cmbPromos->addItem( QString(query.value(3).toString()), QVariant(query.value(0).toInt()) );
    }
}

void COAC::printDateNaissance() {
    cmbJour->addItem( QString::number(1), QVariant("01") );
    cmbJour->addItem( QString::number(2), QVariant("02") );
    cmbJour->addItem( QString::number(3), QVariant("03") );
    cmbJour->addItem( QString::number(4), QVariant("04") );
    cmbJour->addItem( QString::number(5), QVariant("05") );
    cmbJour->addItem( QString::number(6), QVariant("06") );
    cmbJour->addItem( QString::number(7), QVariant("07") );
    cmbJour->addItem( QString::number(8), QVariant("08") );
    cmbJour->addItem( QString::number(9), QVariant("09") );
    cmbJour->addItem( QString::number(10), QVariant("10") );
    cmbJour->addItem( QString::number(11), QVariant("11") );
    cmbJour->addItem( QString::number(12), QVariant("12") );
    cmbJour->addItem( QString::number(13), QVariant("13") );
    cmbJour->addItem( QString::number(14), QVariant("14") );
    cmbJour->addItem( QString::number(15), QVariant("15") );
    cmbJour->addItem( QString::number(16), QVariant("16") );
    cmbJour->addItem( QString::number(17), QVariant("17") );
    cmbJour->addItem( QString::number(18), QVariant("18") );
    cmbJour->addItem( QString::number(19), QVariant("19") );
    cmbJour->addItem( QString::number(20), QVariant("20") );
    cmbJour->addItem( QString::number(21), QVariant("21") );
    cmbJour->addItem( QString::number(22), QVariant("22") );
    cmbJour->addItem( QString::number(23), QVariant("23") );
    cmbJour->addItem( QString::number(24), QVariant("24") );
    cmbJour->addItem( QString::number(25), QVariant("25") );
    cmbJour->addItem( QString::number(26), QVariant("26") );
    cmbJour->addItem( QString::number(27), QVariant("27") );
    cmbJour->addItem( QString::number(28), QVariant("28") );
    cmbJour->addItem( QString::number(29), QVariant("29") );
    cmbJour->addItem( QString::number(30), QVariant("30") );
    cmbJour->addItem( QString::number(31), QVariant("31") );

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
    for( int i = QDateTime::currentDateTime().date().year(); i >= 1900; i--) {
        cmbAnnee->addItem( QString::number(i), QVariant(i) );
    }
}

void COAC::setEleveInfo() {
    nom = ledtNom->text();
    prenom = ledtPrenom->text();
    idPromo = cmbPromos->itemData( cmbPromos->currentIndex() ).toInt();
    adresse = ledtAddr->text();
    ville = ledtVille->text();
    cp = ledtCP->text();
    mail = ledtMail->text();
    qDebug() << "COAC::setEleveInfo() > " << "nom : "    << nom;
    qDebug() << "COAC::setEleveInfo() > " << "prenom : " << prenom;
    qDebug() << "COAC::setEleveInfo() > " << "promos : " << idPromo;
    qDebug() << "COAC::setEleveInfo() > " << "addr : "   << adresse;
    qDebug() << "COAC::setEleveInfo() > " << "ville : "  << ville;
    qDebug() << "COAC::setEleveInfo() > " << "CP : "     << cp;
    qDebug() << "COAC::setEleveInfo() > " << "Mail : "   << mail;
    if(rdbHomme->isChecked()) { sex = "Masculin"; }
    else {                      sex =  "Feminin";  }
    qDebug() << "COAC::setEleveInfo() > " << sex;
    date = cmbAnnee->itemData( cmbAnnee->currentIndex() ).toString() + "-" +cmbMoi->itemData( cmbMoi->currentIndex() ).toString() + "-" + cmbJour->itemData( cmbJour->currentIndex() ).toString();
    qDebug() << "COAC::setEleveInfo() > " << date;
}

void COAC::Envoyer(bool c) {

    Q_UNUSED(c);

    Database db;
    if (db.getDB().isOpen()) {
        QSqlQuery query;
        //qDebug() << mode
        if(mode == Ajout) {
            setEleveInfo();

            query.prepare("INSERT INTO `COAC2016`.`Etudiant` (`id`, `Nom`, `Prenom`, `id_Promo`, `id_Lycee`, `Adresse`, `Ville`, `CP`, `Email`, `Sexe`, `Date_Naissance`, `Image`) "
                          "VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NULL);");
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
            query.exec();
            qDebug() << "COAC::Envoyer() > " << "Sql error:" << query.lastError().text() << ", Sql error code:" << query.lastError().number();
            qDebug() << "COAC::Envoyer() > " << "Sql query:" << query.lastQuery();
        } else {
            setEleveInfo();
            query.prepare("UPDATE Etudiant SET  Nom = ? ,"
                                               "Prenom = ? ,"
                                               "id_Promo = ? ,"
                                               "id_Lycee = ? ,"
                                               "Adresse = ? ,"
                                               "Ville = ? ,"
                                               "CP = ? ,"
                                               "Email = ? ,"
                                               "Sexe = ? ,"
                                               "Date_Naissance = ?"
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
            query.addBindValue(id);
            query.exec();
            qDebug() << "COAC::Envoyer() > " << "Sql error:" << query.lastError().text() << ", Sql error code:" << query.lastError().number();
        }

    } else {
        Envoyer(true);
        return;
    }



}

void COAC::showCamera()
{
    qDebug() << "COAC::showCamera() > " << "set viewfinder";
    camera->my_camera->setViewfinder(viewfinder);

    qDebug() << "COAC::showCamera() > " << "show viewfinder";
    viewfinder->show();
    camera->my_camera->start();
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

void COAC::onDoubleClickListEleve(QModelIndex index)
{

    qDebug() << "COAC::onDoubleClickListEleve() > " << index.data(Qt::UserRole + 1).toInt();
    mode = Edition;

    Database db;

    if (db.getDB().isOpen()) {
        QSqlQuery query;
        query.prepare("SELECT * FROM Etudiant WHERE id = ?");
        query.addBindValue(index.data(Qt::UserRole + 1).toInt());
        query.exec();

        while (query.next()) {
            qDebug() << query.value(1).toString();

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
            int tempDateDay     = cmbJour->findData( piecesDate.value( query.value(10).toString().split("-").length() - 1 ) );
            cmbAnnee->setCurrentIndex(tempDateYear);
            cmbMoi->setCurrentIndex(tempDateMonth);
            cmbJour->setCurrentIndex(tempDateDay);


        }

    } else {
        onDoubleClickListEleve(index);
        return;
    }

}

void COAC::closeEvent(QCloseEvent *) {
    delete elevelist;
    delete addcarte;
    delete addclasse;
}
