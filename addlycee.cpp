#include "addlycee.h"
#include <QLineEdit>
#include <QSqlQuery>
#include <QDebug>

AddLycee::AddLycee(COAC *parentFenetre, Database *database) :
    MyAdd(parentFenetre, database)
{
    this->setWindowTitle("Ajouter un lycée");

    ledtNom = new QLineEdit;

    myLayout->addRow("&Nom du lycée :", ledtNom);
    setLayout(myLayout);

    connect(myButtonBox, SIGNAL(accepted()), this, SLOT(envoyer()));
}

void AddLycee::envoyer(){
    //if(db->getDB().isOpen()){
        QSqlQuery queryPromos;
        queryPromos.prepare("INSERT INTO Lycee VALUES(NULL, ?)");
        queryPromos.addBindValue(ledtNom->text());
        queryPromos.exec();
        qDebug() << "AddLycee::envoyer() > La classe a été ajouter.";
    //} else {
        qDebug() << "AddLycee::envoyer() > Erreur lors de l'ajout de la casse.";
    //}
}
