#include "addcarte.h"
#include "listeleve.h"
#include <QLabel>
#include <QSqlQuery>
#include <QDebug>
#include "database.h"

AddCarte::AddCarte(COAC *parentFenetre, Database *database) :
    MyAdd(parentFenetre, database),
    id(0)
{
    this->setWindowTitle("Ajouter une carte");

    connect(myButtonBox, SIGNAL(accepted()), this, SLOT(envoyer()));

    ledtNum  = new QLineEdit;
    cmbEtat  = new QComboBox;
    pbuEleve = new QPushButton;
    pbuEleve->setText("&Choisir un élève");

    myLayout->addRow("&Numero de \ncarte :", ledtNum);
    myLayout->addRow("&Etat de la\ncarte :", cmbEtat);
    myLayout->addRow("N&om de \nl'élève :", pbuEleve);
    setLayout(myLayout);


    connect(pbuEleve, SIGNAL(clicked(bool)), this, SLOT(showEleveList(bool)));


    cmbEtat->addItem(QString("Autorise"), QVariant(QString("Autorise")));
    cmbEtat->addItem(QString("Non autorise"), QVariant(QString("Non_autorise")));
    cmbEtat->addItem(QString("Perdu"), QVariant(QString("Perdu")));
}


void AddCarte::onDoubleClickListEleve(QModelIndex index){
    id = index.data(Qt::UserRole + 1).toInt();
    qDebug() << "AddCarte::onDoubleClickListEleve() > élève " << id << " sélectionner";
    if(db->getDB().isOpen()){
        QSqlQuery queryPromos;
        queryPromos.prepare("SELECT Nom, Prenom FROM Etudiant WHERE id = ?)");
        queryPromos.addBindValue(id);
        queryPromos.exec();

        queryPromos.next();

        qDebug() << "----------" << queryPromos.value(0).toString() << "-" << queryPromos.value(1).toString();
        pbuEleve->setText(QString(queryPromos.value(0).toString() + "" + queryPromos.value(1).toString()));
    }
}

void AddCarte::showEleveList(bool i){
    Q_UNUSED(i)
    qDebug() << "AddCarte::showEleveList > cliked";
    eleveList = new ListEleve(this, db);
    eleveList->show();
}

void AddCarte::envoyer(){
    qDebug() << "------------------------------------------------" << cmbEtat->currentData().data();
    if(db->getDB().isOpen()){
        if(cmbEtat->currentData().data() ){
            qDebug() << "<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<";
        }
        QSqlQuery queryPromos;
        queryPromos.prepare("INSERT INTO Carte VALUES(NULL, ?, ?, ?)");
        queryPromos.addBindValue(cmbEtat->currentData());
        queryPromos.addBindValue(ledtNum->text());
        queryPromos.addBindValue(id);
        queryPromos.exec();
        qDebug() << "AddCarte::envoyer() > La carte a été ajouter.";
    } else {
        qDebug() << "AddCarte::envoyer() > Erreur lors de la connexion a la base de donnée.";
    }
}
