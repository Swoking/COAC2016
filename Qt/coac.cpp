#include "coac.h"
#include <QDateTime>
#include <QTimer>
#include <QCameraImageCapture>
#include <QStandardItemModel>

COAC::COAC( QWidget *parent ) :
    QMainWindow(parent),
    mode(Ajout)
{
    setupUi(this);

    camera = new Camera();
    elevelist = new EleveList(this);
    connect( actionEleve, SIGNAL(triggered(bool)), this, SLOT(onPushActionEleve(bool)) );
    connect(camera->imageCapture, SIGNAL(imageCaptured(int,QImage)),    camera,   SLOT(processCapturedImage(int,QImage)));
    //connect(camera->imageCapture, SIGNAL(readyForCaptureChanged(bool)), camera,   SLOT(readyForCapture(bool)));
    //connect(camera->imageCapture, SIGNAL(imageCaptured(int,QImage)),    camera,   SLOT(processCapturedImage(int,QImage)));
    //connect(camera->imageCapture, SIGNAL(imageSaved(int,QString)),      camera,   SLOT(imageSaved(int,QString)));
    //connect(camera->imageCapture, SIGNAL(error(int,QCameraImageCapture::Error,QString)), this, SLOT(displayCaptureError(int,QCameraImageCapture::Error,QString)));

    connect(pbuEnvoyer, SIGNAL(clicked(bool)), this, SLOT(Envoyer(bool)));
    connect(pbuTakeImage, SIGNAL(clicked(bool)), this, SLOT(imageCapture(bool)));
    showCamera();
}

void COAC::onPushActionEleve(bool i){
    Q_UNUSED(i)
    elevelist->show();
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
    for( int i = 1; i <= 31; i++) {
        cmbJour->addItem( QString::number(i), QVariant(i) );
    }
    cmbMoi->addItem( QString("Janvier"),   QVariant(1) );
    cmbMoi->addItem( QString("Février"),   QVariant(2) );
    cmbMoi->addItem( QString("Mars"),      QVariant(3) );
    cmbMoi->addItem( QString("Avril"),     QVariant(4) );
    cmbMoi->addItem( QString("Mai"),       QVariant(5) );
    cmbMoi->addItem( QString("Juin"),      QVariant(6) );
    cmbMoi->addItem( QString("Juillet"),   QVariant(7) );
    cmbMoi->addItem( QString("Aoùt"),      QVariant(8) );
    cmbMoi->addItem( QString("Septembre"), QVariant(9) );
    cmbMoi->addItem( QString("Octobre"),   QVariant(10) );
    cmbMoi->addItem( QString("Novembre"),  QVariant(11) );
    cmbMoi->addItem( QString("Décembre"),  QVariant(12) );
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
//------------
            query.prepare("UPDATE Etudiant (Nom, Prenom, id_Promo, Adresse, Ville, CP, email, Sexe, Date_Naissance, id_Lycee ) "
                          "VALUES (?, ?, ?, ?, ?, ?, ?, ? ,?);");
            query.addBindValue(nom);
            query.addBindValue(prenom);
            query.addBindValue(idPromo);
            query.addBindValue(adresse);
            query.addBindValue(ville);
            query.addBindValue(cp);
            query.addBindValue(mail);
            query.addBindValue(sex);
            query.addBindValue(date);
            query.addBindValue(1);
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
    //camera->imageCapture->capture();
    qDebug() << "COAC::imageCapture() > " << "show image";
    qDebug() << "COAC::imageCapture() > " << camera->image.byteCount();
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
            //nom = ledtNom->text();
            //prenom = ledtPrenom->text();
            //idPromo = cmbPromos->itemData( cmbPromos->currentIndex() ).toInt();
            //adresse = ledtAddr->text();
            //ville = ledtVille->text();
            //cp = ledtCP->text();
            //mail = ledtMail->text();
            //if(rdbHomme->isChecked()) { sex = "Masculin"; }
            //else {                      sex =  "Feminin";  }
            //date = cmbAnnee->itemData( cmbAnnee->currentIndex() ).toString() + "-" +cmbMoi->itemData( cmbMoi->currentIndex() ).toString() + "-" + cmbJour->itemData( cmbJour->currentIndex() ).toString();
qDebug() << query.value(1).toString();

            id = query.value(0).toInt();
            ledtNom->setText( query.value(1).toString() );
            ledtPrenom->setText( query.value(2).toString() );
            int test = cmbPromos->findData( query.value(3).toInt() );
            cmbPromos->setCurrentIndex( test );
            ledtAddr->setText( query.value(4).toString() );
            ledtCP->setText( query.value(4).toString() );
            ledtMail->setText( query.value(5).toString() );

        }

    } else {
        onDoubleClickListEleve(index);
        return;
    }

}
