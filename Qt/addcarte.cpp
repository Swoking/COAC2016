#include "addcarte.h"

AddCarte::AddCarte(COAC *fen, QWidget *parent) :
    QDialog(parent),
    fenetre(fen)
{
    setupUi(this);

    elevelist = new EleveList(this);
    connect(pbuChooseEleve, SIGNAL(clicked(bool)), this, SLOT(onPushActionAddClasse(bool)));
    connect(buttonBox, SIGNAL(accepted()), this, SLOT(onAcceptedAddCarte()));

    cmbStatus->addItem("Autorisé",      QVariant("Autorise"));
    cmbStatus->addItem("Non autorisé",  QVariant("nomautorisé"));
    cmbStatus->addItem("Perdu",         QVariant("perdu"));

}

AddCarte::~AddCarte(){
    elevelist->hide();
}

void AddCarte::onPushActionAddClasse(bool i){
    Q_UNUSED(i)
    elevelist = new EleveList(this);
    elevelist->show();
}

void AddCarte::onDoubleClickListEleve(QModelIndex index){
    id = index.data(Qt::UserRole + 1).toInt();
    qDebug() << "AddCarte::onDoubleClickListEleve() > l'ID de l'élève sélectionner est" << id;
    elevelist->hide();

    Database db;
    if(db.getDB().isOpen()) {
        QSqlQuery query;
        query.prepare("SELECT nom, prenom FROM Etudiant WHERE id = ?");
        query.addBindValue(id);
        query.exec();
        query.next();
        pbuChooseEleve->setText(query.value(0).toString() + " " + query.value(1).toString());
    }
   // QSqlQuery
}

void AddCarte::closeEvent(QCloseEvent *){
    elevelist->hide();
}
void AddCarte::onAcceptedAddCarte(){
    qDebug() << "AddCarte::onAcceptedAddCarte() > Ok";

    Database db;
    if(db.getDB().isOpen()) {
        QSqlQuery query;
        query.prepare("INSERT INTO Carte(Etat, Num_Carte, id_Etudiant) "
                      "VALUE(?, ?, ?)");
        query.addBindValue(cmbStatus->currentData());
        query.addBindValue(ledtNum->text());
        query.addBindValue(id);
        query.exec();
    }
}
